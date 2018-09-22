pragma solidity ^0.4.24;

import './Diagnosisses.sol';
import './ProxyController_v1.sol';
import './TokenInsurance.sol';
import './TokenInterface.sol';
import 'zeppelin-solidity/contracts/token/ERC20/StandardToken.sol';

contract Insurances{
    
    struct Insurance{
        uint plan; //cancer:1 or hospital:2
        uint premium; //一回あたりの掛け金
        uint pay; //有事の時に支払われる保険金
//        uint fund; //積立額
    } 
    
    mapping(address => Insurance) public insurances;
    Diagnosisses public diagnosisses;
    ProxyController_v1 public proxy_v1;    
    TokenInsurance public tokeninsurance;
    TokenInterface public tokeninterface;

    address InsuranceAddress = msg.sender;
    
    // nonce for each account
    mapping(address => uint) nonces;

    function nonceOf(address _owner) public constant returns (uint nonce) {
        return nonces[_owner];
    }

    //function Insurances(address _diagnosisses) public{
    constructor(address _diagnosisses,address _tokeninsurance)public{
	require(_diagnosisses != 0x0);
        diagnosisses = Diagnosisses(_diagnosisses);
	require(_tokeninsurance != 0x0);
        tokeninsurance = TokenInsurance(_tokeninsurance);
    }
   
    function sender() public returns (address){
        return msg.sender;
    }
    
    //保険契約申請
    //入力:患者のID,プラン名
    //出力:bool
    function contractInsurance(uint _plan) public returns (bool){ //userのパラメータは抜いてmsg.sender
        //Z.com経由用の処理
	// 診断がされていなければ、医師のアドレスは初期値（0x0）
        address x = diagnosisses.getDoctoraddress(msg.sender);
        if(x == 0x0) return false;
        //病状から保険加入可否を判定　
        uint y = diagnosisses.getStay(msg.sender);
        bool z = diagnosisses.getCancer(msg.sender);
        if(y > 10 || z) return false;
        if(_plan == 1){ //入院保険(id:1)
            insurances[msg.sender].plan = _plan;
            insurances[msg.sender].premium = 100;
            insurances[msg.sender].pay = 100000;
            //insurances[msg.sender].fund = 0;
            return true;
        }
        
        else if(_plan == 2){ //ガン保険(id:2)
            insurances[msg.sender].plan = _plan;
            insurances[msg.sender].premium = 300;
            insurances[msg.sender].pay = 500000;
            //insurances[msg.sender].fund = 0;
            return true;
        }
        else return false;
    }
    
    function checkPlan() public returns (uint){
	return insurances[msg.sender].plan;
    }
    function checkPremium() public returns (uint){
	return insurances[msg.sender].premium;
    }
    function checkPay() public returns (uint){
	return insurances[msg.sender].pay;
    }
    //function checkFund() public returns (uint){
//	return insurances[msg.sender].fund;
  //  }
    
    //保険金受け取り申請
    function receiveInsurance() public returns (bool){
        // 診断がされていなければ、医師のアドレスは初期値（0x0）
        //address x = diagnosisses.getDoctoraddress(msg.sender);
        //if(x == 0x0) return false;
        //病状から保険金受け取り可否を判定
        //入院保険プランの場合
        if(insurances[msg.sender].plan == 1){
            uint y = diagnosisses.getStay(msg.sender);
            if(y < 10) return false;
        }
        //ガン保険プランの場合
        else if(insurances[msg.sender].plan == 2){
            bool z = diagnosisses.getCancer(msg.sender);
            if(!z) return false;
        }

	else return false;
        //保険料が一定額支払われていない場合は無効
        
//	if(insurances[msg.sender].fund < insurances[msg.sender].premium * 3) return false;

	//保険金受け取り処理
        tokeninsurance.approve(this,insurances[msg.sender].pay); 
	tokeninsurance.transferFrom(this,msg.sender,insurances[msg.sender].pay);       

        return true;
    }
    
    //保険料の支払い（送金）
    //function payPremium(uint _nonce,bytes _sign) public returns (bool){
    function payPremium(address _to) public returns (bool){
	tokeninsurance.transfer(_to,insurances[msg.sender].premium);       
        //送金した額を記録
//	insurances[msg.sender].fund += insurances[msg.sender].premium;
        return true;
    }


    // calcEnvHash  
    function calcEnvHash(bytes32 _functionName) constant returns (bytes32 hash) {
        hash = sha3(this);
        hash = sha3(hash, _functionName);
    } 
    
    function recoverAddress(bytes32 _hash, bytes _sign) constant returns (address recoverdAddr) {
        bytes32 r;
        bytes32 s;
        uint8 v;

        assert(_sign.length == 65);

        assembly {
            r := mload(add(_sign, 32))
            s := mload(add(_sign, 64))
            v := byte(0, mload(add(_sign, 96)))
        }

        if (v < 27) v += 27;
        assert(v == 27 || v == 28);

        recoverdAddr = ecrecover(_hash, v, r, s);
        assert(recoverdAddr != 0);
    }
 
}

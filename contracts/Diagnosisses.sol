pragma solidity ^0.4.24;

import 'zeppelin-solidity/contracts/token/ERC20/StandardToken.sol';

contract Diagnosisses{
    
    struct Diagnosis{
        address doctoraddress;//診断をした医師のアドレス
        uint stay;//入院日数
        bool cancer;//ガンの有無
    } 
    
    mapping(address => Diagnosis) public diagnosisses; //配列は後からでも？
    mapping(address => bool) public doctorlist;
    
    event addDiagnosisEvent(address user,bytes2 doctorID,uint stay,bool cancer);
   
    address DiagnosissesAddress = msg.sender;
    
    // nonce for each account
    mapping(address => uint) nonces;

    function nonceOf(address _owner) public constant returns (uint nonce) {
        return nonces[_owner];
    }
    
    //診断結果の登録
    //入力:患者のID,入院日数,ガンの有無
    function addDiagnosis(address _user,uint _stay,bool _cancer) public returns (bool){
        diagnosisses[_user].doctoraddress = msg.sender;
        diagnosisses[_user].stay = _stay;
        diagnosisses[_user].cancer = _cancer;
        return true;
    }
    

    //医者が自身の承認を申し込む
    //今回は承認の判定はつけず、この申請を忘れなければ優良な医者と見做される
    function registDoctor() public returns (bool){
	doctorlist[msg.sender] = true;
        return true;
    }
    
    function checkDoctor(address _doctor) public returns (bool){
        return doctorlist[_doctor];
    }
    
    function getDoctoraddress(address _user) public returns (address){
        return diagnosisses[_user].doctoraddress;
    }
    
    function getStay(address _user) public returns (uint){
        return diagnosisses[_user].stay;
    }

    function getCancer(address _user) public returns (bool){
        return diagnosisses[_user].cancer;
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

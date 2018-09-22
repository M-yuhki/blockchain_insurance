pragma solidity ^0.4.24;

import 'zcom-contracts/contracts/VersionLogic.sol';
import './TokenInsurance.sol';

contract ProxyControllerLogic_v1 is VersionLogic {

    constructor(ContractNameService _cns) VersionLogic (_cns, "ProxyController") public {}

    function getSymbol(address _tokenAddress) public constant returns (bytes32 symbol) {
        return TokenInsurance(_tokenAddress).symbol();
    }

    function getName(address _tokenAddress) public constant returns (bytes32 name) {
        return TokenInsurance(_tokenAddress).name();
    }

    function getTotalSupply(address _tokenAddress) public constant returns (uint totalSupply) {
        return TokenInsurance(_tokenAddress).totalSupply();
    }

    function getNonce(address _tokenAddress, address _addr) public constant returns (uint nonce) {
        return TokenInsurance(_tokenAddress).nonceOf(_addr);
    }

    function balanceOf(address _tokenAddress, address _addr) public constant returns (uint balance) {
        return TokenInsurance(_tokenAddress).balanceOf(_addr);
    }

    function transferWithSign(address _tokenAddress, address _to, uint _amount, uint _nonce, bytes _sign) public onlyByVersionContractOrLogic {
        require(TokenInsurance(_tokenAddress).transferWithSign(_to, _amount, _nonce, _sign));
    }
    
}

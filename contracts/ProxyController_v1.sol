pragma solidity ^0.4.24;

import 'zcom-contracts/contracts/VersionContract.sol';
import './ProxyControllerLogic_v1.sol';

contract ProxyController_v1 is VersionContract {
    ProxyControllerLogic_v1 public logic_v1;

    constructor(ContractNameService _cns, ProxyControllerLogic_v1 _logic_v1) VersionContract(_cns, "ProxyController") public {
        logic_v1 = _logic_v1;
    }

    function getSymbol(address _tokenAddress) public constant returns (bytes32 symbol) {
        return logic_v1.getSymbol(_tokenAddress);
    }

    function getName(address _tokenAddress) public constant returns (bytes32 name) {
        return logic_v1.getName(_tokenAddress);
    }

    function getTotalSupply(address _tokenAddress) public constant returns (uint totalSupply) {
        return logic_v1.getTotalSupply(_tokenAddress);
    }

    function getNonce(address _tokenAddress, address _addr) public constant returns (uint nonce) {
        return logic_v1.getNonce(_tokenAddress, _addr);
    }

    function balanceOf(address _tokenAddress, address _addr) public constant returns (uint balance) {
        return logic_v1.balanceOf(_tokenAddress, _addr);
    }

    function transferWithSign(bytes _sign, address _tokenAddress, address _to, uint _amount, uint _nonce, bytes _clientSign) public {
        logic_v1.transferWithSign(_tokenAddress, _to, _amount, _nonce, _clientSign);
    }
}

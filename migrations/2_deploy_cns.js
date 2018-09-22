const ContractNameService = artifacts.require('zcom-contracts/contracts/ContractNameService.sol');
//TODO
const zcbc = require('zcom-blockchain-cp');

module.exports = function(deployer, network, accounts) {
    deployer.deploy(ContractNameService).then(() => {
        zcbc.registerCNS(ContractNameService.address, true);
    });
}

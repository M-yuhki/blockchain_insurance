const ContractNameService = artifacts.require('zcom-contracts/contracts/ContractNameService.sol'),
    ProxyController_v1 = artifacts.require('./ProxyController_v1.sol'),
    ProxyControllerLogic_v1 = artifacts.require('./ProxyControllerLogic_v1.sol');
// TODO
const zcbc = require('zcom-blockchain-cp');

module.exports = function(deployer) {
    deployer.deploy(ProxyControllerLogic_v1, ContractNameService.address).then(function(){
        return deployer.deploy(
            ProxyController_v1,
            ContractNameService.address,
            ProxyControllerLogic_v1.address
            );
    }).then(function() {
        return ContractNameService.deployed();
    }).then(function(instance) {
        return instance.setContract(
            'ProxyController',
            1,
            ProxyController_v1.address,
            ProxyControllerLogic_v1.address
            );
    }).then(function() {
        return zcbc.addContract(ProxyController_v1.address, JSON.stringify(
            ProxyController_v1.abi
            ), 4000000, true, 'ProxyController');
    }).then(function() {
        return zcbc.compileOutputFiles();
    });
}

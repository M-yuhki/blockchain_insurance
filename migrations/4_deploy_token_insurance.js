const TokenInsurance = artifacts.require('./TokenInsurance.sol');
const Diagnosisses = artifacts.require('./Diagnosisses.sol');
const Insurances = artifacts.require('./Insurances.sol');

module.exports = function(deployer) {
    const initialSupply = 10000000000 ;
    deployer.deploy(TokenInsurance , initialSupply);
    deployer.deploy(Diagnosisses).then(function(){
        return deployer.deploy(Insurances,Diagnosisses.address,TokenInsurance.address);
    });
}



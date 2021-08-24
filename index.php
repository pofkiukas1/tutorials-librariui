<?php



require_once '/public_html/development/tarpine/vendor/autoload.php'; //full path arba kazka protingiau nei as
use Paysera\Client\TransfersClient\ClientFactory;
use Paysera\Client\TransfersClient\Entity as Entities;
use Paysera\Client\TransfersClient\Entity\Money as Money;
use Paysera\Client\TransfersClient\Entity\TransferBeneficiary as Beneficiary;
use Paysera\Client\TransfersClient\Entity\Payer as Payer;
use Paysera\Client\TransfersClient\Entity\Currency as currency;
use Paysera\Client\TransfersClient\Entity\TransferPurpose as Purpose;


$clientFactory = new ClientFactory([
    'base_url' => 'https://wallet.paysera.com/transfer/rest/v1/', // optional, in case you need a custom one.
    'mac' => [                                        // use this, it API requires Basic authentication.
        'mac_id' => '', //mac id ivedi
        'mac_secret' => '', //mac secret ivedi
    ],


]);




$transfersClient = $clientFactory->getTransfersClient();
$transferInput = new Entities\TransferInput();

$amountMoney = new Money(['amount' =>"0.01",'currency' =>"EUR"]); //kiekis ir valiute
$benef = new Beneficiary(['type' =>"bank","name"=>"IMONES ARBA ZMOGAUS VARDAS","bank_account"=>["iban"=>"SASKAITA"]]);
$payer = new Payer(["account_number"=>"IS KO MOKAME"]);
$purpose = new Purpose(["details"=>"PASKIRTIS"]);


$transferInput->setAmount($amountMoney);
$transferInput->setBeneficiary($benef);
$transferInput->setPayer($payer);
$transferInput->setPurpose($purpose);

    
$result = $transfersClient->createTransfer($transferInput);
$id = $result->getId();
$result2 = $transfersClient->getTransfer("ID TIKRINAMO"); // paktirkinimui 
$transferRegistrationParameters = new Entities\TransferRegistrationParameters();
$signedResult = $transfersClient->signTransfer($id,$transferRegistrationParameters);  //patvirtinimas pavedimas perduodama id ir kazkokie sudai papildomi kol kas ju nenustaciau ir perdaviau tuscia objekta, nes kitaip neleido
echo($result2->getStatus());

?>
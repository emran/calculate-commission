<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

require "./vendor/autoload.php";

$binProvider = new LookupBin();
$rateProvider = new ExchangeRate();
$calculateCommission = new CalculateCommission($binProvider, $rateProvider);

foreach (explode("\n", file_get_contents($argv[1])) as $row) {
  if (!$row) {
    break;
  }

  $rowData = json_decode($row, true);

  $countryCode = $calculateCommission->BinProvider($rowData['bin']);
  $rate = $calculateCommission->currencyRateProvider($rowData['currency']);
  $amountAfter = $calculateCommission->getAmountAfter($rate, $rowData['currency'], $rowData['amount']);
  
  $isEu = $calculateCommission->isEu($countryCode);
  $commissionRate = $calculateCommission->getCommissionRate($isEu);
  
  $finalAmount = $calculateCommission->applyRate($amountAfter, $commissionRate);

  echo $countryCode. ' ==> '. $rate. ' --> '. $amountAfter. ' --> '. $finalAmount;
  print "\n";
}
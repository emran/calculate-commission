<?php
require(__DIR__ .'/../interface/Bin.php');

class LookupBin implements Bin
{
  private $URL = 'https://lookup.binlist.net/';
  private $result;

  public function loadMetaDataByCard(string $cardNumber) {
    $result = file_get_contents($this->URL.$cardNumber);
    $this->result = json_decode($result);
  }
  public function getCountryCode() {
    return $this->result->country->alpha2;
  }
}
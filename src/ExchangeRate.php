<?php
require('CurrencyRate.php');

class ExchangeRate implements CurrencyRate
{
  private $URL = 'https://api.exchangeratesapi.io/latest';
  private $result;

  public function load() {
    $this->result = @json_decode(file_get_contents($this->URL), true);
  }
  public function getRate($currency) {
    return $this->result['rates'][$currency];
  }
}
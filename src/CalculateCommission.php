<?php
/**
 * Calculate commission
 * 
 * @author Emranul Hadi <emranulhadi@gmail.com>
 */
class CalculateCommission 
{

  // EU-issued country code
  const EU = ['AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK'];
  
  private $binProvider;
  private $rateProvider;

  public function __construct(Bin $bin, ExchangeRate $rate) {
    $this->binProvider = $bin;
    $this->rateProvider = $rate;
  }

  /**
   * Determine country code is EU supported or not
   * 
   * @param countryCode string
   * @return boolean
   */
  public function isEu($countryCode) {
    return in_array($countryCode, self::EU);
  }

  /**
   * Define commission rate based on EU supported
   * 
   * @param isEu boolean
   * @return float
   */
  public function getCommissionRate($isEu) {
    return $isEu ? 0.01 : 0.02;
  }

  public function getCountryCodeByCardNumber($cardNumber) {
    $this->binProvider->loadMetaDataByCard($cardNumber);
    return $this->binProvider->getCountryCode();
  }

  public function getRateByCurrency($currency) {
    $this->rateProvider->load();
    return $this->rateProvider->getRate($currency);
  }

  /**
   * Get amount based on currency and rate
   * 
   * @param rate int
   * @param currency string
   * @param amount float
   * 
   * @return float
   */
  public function getAmountBasedOnRateAndCurrency($rate, $currency, $amount) {
    if ($currency === 'EUR' or $rate === 0) {
      $amountFixed = $amount;
    } elseif ($currency !== 'EUR' or $rate > 0) {
        $amountFixed = $amount / $rate;
    }

    return $amountFixed;
  }

  /**
   * Apply commission rate
   * 
   * @param amount float
   * @param commissionRate float
   * @return float
   */
  public function applyCommission($amount, $commissionRate) {
    return round($amount * $commissionRate, 2);
  }
}
<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class CalculateCommissionTest extends TestCase
{

  private $calculateCommission;

    public function __construct()
    {
        parent::__construct();

        $this->calculateCommission = new CalculateCommission(new LookupBin(), new ExchangeRate());
    }
    
    public function testIsEu(): void
    {
        $this->assertEquals($this->calculateCommission->isEu('AT'), true);
        $this->assertEquals($this->calculateCommission->isEu('BE'), true);
        $this->assertEquals($this->calculateCommission->isEu('XY'), false);
    }

    public function testGetCommissionRate(): void
    {
        $this->assertEquals($this->calculateCommission->getCommissionRate(true), 0.01);
        $this->assertEquals($this->calculateCommission->getCommissionRate(false), 0.02);
    }

    public function testGetAmountBasedOnRateAndCurrency(): void
    {
        $this->assertEquals($this->calculateCommission->getAmountBasedOnRateAndCurrency(0, 'EUR', 100), 100);
        $this->assertEquals($this->calculateCommission->getAmountBasedOnRateAndCurrency(2, 'BDT', 100), 50);
        $this->assertEquals($this->calculateCommission->getAmountBasedOnRateAndCurrency(0, 'BDT', 100), 100);
    }
}
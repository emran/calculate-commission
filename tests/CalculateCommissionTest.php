<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class CalculateCommissionTest extends TestCase
{

  private $calculateCommission;

    public function __construct()
    {
        parent::__construct();

        $this->calculateCommission = new CalculateCommission();
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

    public function testGetAmountAfter(): void
    {
        // $this->assertEquals($this->calculateCommission->getAmountAfter(true), 0.01);
        // $this->assertEquals($this->calculateCommission->getAmountAfter(false), 0.02);
    }
}
<?php

interface CurrencyRate
{
    public function load();
    public function getRate(string $currency);
}
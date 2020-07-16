<?php

interface Bin
{
    public function loadMetaDataByCard(string $cardNumber);
    public function getCountryCode();
}
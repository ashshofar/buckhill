<?php

namespace Ashshofar\Exchange;

use GuzzleHttp\Client;

class Exchange
{
    private $arrayCurrency;

    public function __construct()
    {
        $this->getCurrency();
    }

    /**
     * Get currency data
     *
     * @return void
     */
    public function getCurrency(): void
    {
        $xmlString = file_get_contents('https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');
        $xmlObject = simplexml_load_string($xmlString);
        $this->arrayCurrency = $xmlObject->Cube->Cube->Cube;
    }

    /**
     * Convert currency
     *
     * @param float $amount
     * @param string $currency
     * @return float|string
     */
    public function convert(float $amount, string $currency): float|string
    {
        $rate = $this->getRate($currency);

        if (is_null($rate)) {
            return 'Invalid currency';
        }

        return $amount * $rate;
    }

    /**
     * Get rate
     *
     * @param $currency
     * @return mixed
     */
    public function getRate($currency): mixed
    {
        $rate = null;
        for ($i=0; $i<count($this->arrayCurrency); $i++) {
            if ($this->arrayCurrency[$i]['currency'] == strtoupper($currency)) {
                $rate = $this->arrayCurrency[$i]['rate'];
                break;
            }
        }

        return $rate;
    }
}

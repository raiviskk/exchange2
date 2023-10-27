<?php
namespace App;

class CurrencyConversion
{
    private ?Currency $base;
    private float $amountFastForex;
    private float $amountFxRates;
    private float $amountMetalPrice;

    public function __construct(?Currency $base, float $amountFastForex, float $amountFxRates, float $amountMetalPrice)
    {
        $this->base = $base;
        $this->amountFastForex = $amountFastForex;
        $this->amountFxRates = $amountFxRates;
        $this->amountMetalPrice = $amountMetalPrice;
    }

    public function getBase(): ?Currency
    {
        return $this->base;
    }

    public function getAmountFastForex(): float
    {
        return $this->amountFastForex;
    }

    public function getAmountFxRates(): float
    {
        return $this->amountFxRates;
    }

    public function getAmountMetalPrice(): float
    {
        return $this->amountMetalPrice;
    }

    public static function fromApiData(array $fastForexData, string $exchangeCurrency, array $fxRatesData, array $metalPriceData): CurrencyConversion
    {
        $base = new Currency($fastForexData['base']);
        $amountFastForex = (float)($fastForexData['result'][$exchangeCurrency]);
        $amountFxRates = (float)($fxRatesData['result']);
        $amountMetalPrice = (float)($metalPriceData['result']);

        return new CurrencyConversion($base, $amountFastForex, $amountFxRates, $amountMetalPrice);
    }
}
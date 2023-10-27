<?php

require 'vendor/autoload.php';
use Symfony\Component\Console\Output\ConsoleOutput;

$output = new ConsoleOutput();

$data = readline("Enter the amount and base currency (e.g., '100 USD'): ");
[$amount, $baseCurrency] = explode(' ', $data);
$exchangeCurrency = readline("Enter the exchange currency: ");

$fastForexApi = new App\FastForexApi();
$fxRatesApi = new App\FxRatesApi();
$metalPriceApi = new App\MetalPriceApi();

$fastForexData = $fastForexApi->fetchData($baseCurrency, $exchangeCurrency, $amount);
$fxRatesData = $fxRatesApi->fetchData($baseCurrency, $exchangeCurrency, $amount);
$metalPriceData = $metalPriceApi->fetchData($baseCurrency, $exchangeCurrency, $amount);

$conversion = App\CurrencyConversion::fromApiData($fastForexData, $exchangeCurrency, $fxRatesData, $metalPriceData);

$values = [
    "Exchanging at FastForex" => $conversion->getAmountFastForex(),
    "Exchanging at FxRates" => $conversion->getAmountFxRates(),
    "Exchanging at MetalPrice" => $conversion->getAmountMetalPrice()
];

arsort($values);

$highestSource = key($values);
$highestValue = reset($values);

echo "--------------------------------" . PHP_EOL;
$output->writeLn('<fg=red>' . sprintf('Highest: %s: %s', $highestSource, $highestValue) . '</>');

array_shift($values);

foreach ($values as $source => $amount) {
    $output->writeLn(sprintf('<fg=white>%s: %s</>', $source, $amount));
}

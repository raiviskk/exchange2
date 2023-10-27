<?php


namespace App;
class Currency
{
    public string $code;


    public function __construct(string $code )
    {
        $this->code = $code;
    }


    public function getCode(): string
    {
        return $this->code;
    }
}
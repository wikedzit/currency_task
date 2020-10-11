<?php

/*
 * This simple script, implements a single Class (Money), and the goal of this Helper Class is to allow smooth management
 * of monetary values for different currencies.. Using this class money values are processed as integers allowing
 * preservation of values.
 */

class Money {

    protected $value;
    protected $currency;
    protected $cent_points = [
        "EUR" => 2,
        "USD" => 2,
    ];

    /**
     * Money constructor.
     * @param $currency
     * @param $value
     */
    public function __construct($currency, $value) {
        $this->currency = $currency;
        $this->setValue($value);
    }

    /**
     * Call this function to check if the currency values matches the calling currency
     * @param $currency
     * @return bool
     */
    public function currencyIs($currency) {
        return $this->currency === strtoupper($currency);
    }

    /**
     * This represents the number of decimal point for a given currency. Currentcy points could be stored and accessed
     * as setting values when dealing with money values
     * @return int|mixed
     */
    public function getPoints() {
       $currencies = array_keys($this->cent_points);
       if (in_array($this->currency, $currencies)) {
           return $this->cent_points[$this->currency];
       }
       return 0;
    }

    /**
     * Call this function to immediately convert the money value to an integer value
     * @param $value
     */
    public function setValue($value) {
        $this->value  = intval($value * pow(10, $this->getPoints()));
    }

    /**
     * Call this function to preprocess and extract the original value
     * @return string
     */
    public function getRealValue() {
        $value = $this->value / pow(10, $this->getPoints());
        return sprintf("%.{$this->getPoints()}f", $value);
    }

    /**
     * @param int $val
     * @return string
     */
    public function multiply($val=0) {
        $this->value *= $val;
        return $this->getRealValue();
    }

    /**
     * @param int $val
     * @return null|string
     */
    public function division($val=1) {
        if($val == 0){
            //Throw an error
            return null;
        }
        $this->value /= $val;
        return  $this->getRealValue();
    }

    /**
     * @param Money $money
     * @return null|string
     */
    public function sum(Money $money) {
        if(!$money->currencyIs($this->currency)) {
            //Throw an error
            return null;
        }
        $this->value +=$money->value;
        return  $this->getRealValue();
    }

    /**
     * @param Money $money
     * @return string
     */
    public function subtract(Money $money) {
        if(!$money->currencyIs($this->currency)) {
            //Throw an error
        }
        $this->value -=$money->value;
        return  $this->getRealValue();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s %s\n", $this->currency, $this->getRealValue());
    }
}

//Test code
$eur1  = new Money('EUR', 598.07);
$eur2  = new Money('EUR', 1.37);
$eur1->sum($eur2);
print($eur1);


$usd1 = new Money('USD', 456.00);
$usd2 = new Money('USD', 219.08);

$usd1->subtract($usd2);
print($usd1);

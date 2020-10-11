<?php
class Money {

    protected $value;
    protected $currency;
    protected $cent_points = [
        "EUR" => 2,
        "USD" => 2,
    ];

    public function __construct($currency, $value) {
        $this->currency = $currency;
        $this->setValue($value);
    }

    public function currencyIs($currency) {
        return $this->currency === strtoupper($currency);
    }

    public function getPoints() {
       $currencies = array_keys($this->cent_points);
       if (in_array($this->currency, $currencies)) {
           return $this->cent_points[$this->currency];
       }
       return 0;
    }

    public function setValue($value) {
        $this->value  = intval($value * pow(10, $this->getPoints()));
    }

    public function getRealValue() {
        $value = $this->value / pow(10, $this->getPoints());
        return sprintf("%.{$this->getPoints()}f", $value);
    }

    public function multiply($val=0) {
        $this->value *= $val;
        return $this->getRealValue();
    }

    public function division($val=1) {
        if($val == 0){
            //Throw an error
            return null;
        }
        $this->value /= $val;
        return  $this->getRealValue();
    }

    public function sum(Money $money) {
        if(!$money->currencyIs($this->currency)) {
            //Throw an error
            return null;
        }
        $this->value +=$money->value;
        return  $this->getRealValue();
    }

    public function subtract(Money $money) {
        if(!$money->currencyIs($this->currency)) {
            //Throw an error
        }
        $this->value -=$money->value;
        return  $this->getRealValue();
    }

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

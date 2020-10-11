<?php
class MathOperations {

    /**
     * This method takes in two values and multiplies them together
     * @param $value1
     * @param $value2
     * @return string
     */
    public function multiply($value1, $value2) {
        return $value1 * $value2;
    }

    /**
     * This methofs takes in two numbers and divides them.
     * Since there are no divisions by zero, we check to make sure $value2 is not zero otherwise we throw an error
     * @param $value1
     * @param $divisor
     * @return null|string
     */
    public function division($value1, $divisor) {
        if($divisor == 0){
            //Throw an error
            return null;
        }
        return  $value1 / $divisor;
    }

    /**
     * @param $value1
     * @param $value2
     * @return null|string
     */
    public function sum($value1, $value2) {
        return $value1 + $value2;
    }

    /**
     * @param $value1
     * @param $value2
     * @return string
     */
    public static function subtract($value1, $value2) {
        return $value1 - $value2;
    }
}

<?php

namespace Framework;

class Validation
{
    /**
     * Validate a string
     * @param string $value
     * @param int $min
     * @param int $max
     * @return bool
     */
    public static function string($value, $min = 1, $max = INF)
    {
        if (is_string($value)) {
            $value = trim($value);
            $length = strlen($value);
            if ($length >= $min && $length <= $max) {
                return true;
            }
        }
        return false;
    }

    /**
     * Validate email adresse
     * @param string $email
     * @return mixed
     */
    public static function email($email)
    {
        $email = trim($email);
        return filter_var($email, FILTER_VALIDATE_EMAIL); //return false ila email machi valid and it return the email if it is valid
    }

    /**
     * Match a value 
     * @param string $value1
     * @param string $value2
     * @return bool
     */
    public static function match($value1, $value2)
    {
        $value1 = trim($value1);
        $value2 = trim($value2);

        return $value1 === $value2;
    }
}

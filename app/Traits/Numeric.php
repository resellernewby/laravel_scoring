<?php

namespace App\Traits;

trait Numeric
{
    /**
     * @param string $string
     */
    public function getNumeric($string)
    {
        return preg_replace('/\D/', '', ($string ?: 0));
    }

    public function getPhoneNumber($string)
    {
        $phone = $this->getNumeric($string);
        if ($phone[0] == 0) {
            return substr_replace($phone, '62', 0, 1);
        }

        return $phone;
    }
}

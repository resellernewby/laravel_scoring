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
}

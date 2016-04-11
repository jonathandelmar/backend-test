<?php

namespace Finder;

use Symfony\Component\Intl\Intl;
\Locale::setDefault('en');

class Helpers
{
    public function months($period)
    {
        if(!is_numeric($period)) {
            return '';
        }

        return ($period == 1) ? "1 month" : "$period months";
    }

    public function yesNo($value)
    {
        if ($value == '0' || strtolower($value) == 'no') {
            return 'No';
        }
        if ($value == '1' || strtolower($value) == 'yes') {
            return 'Yes';
        }

        return '';
    }

    public function money($value, $decimals = 2)
    { 
        if (is_numeric($value) && is_numeric($decimals)) {
            if ( !fmod( $value, 1 ) ) {
                $decimals = 0;
            }
            $value = sprintf('$%s', number_format( floor( $value * 100) / 100, $decimals ) );
        }
        return $value;
    }

    public function date($data, $format = 'Y-m-d H:i:s')
    {
        try {
            $time = new \DateTime($data);
        }
        catch(Exception $e) {
            return $data;
        }

        return $time->format($format);
    }

    public function pluralize($data, $unit)
    {
        if (!is_numeric($data)) {
            return $data;
        }
        if ($data == 1) {
            return sprintf('%s %s', $data, $unit);
        } else {
            return sprintf('%s %ss', $data, $unit);
        }
    }   
    
    /**
     * Returns a string with a value prepended with currency symbol
     * 
     * @param int $value
     * @param str $code
     * 
     * @see https://symfony.com/doc/current/components/intl.html#currencies
     * @return str
     */
    public function currency( $value, $code ) 
    {                
        return is_numeric($value) ? Intl::getCurrencyBundle()->getCurrencySymbol( $code ) . number_format( $value, 2 ) : $value;
    }
    
    /**
     * Returns a human-readable concatenated string list
     * 
     * @param array $values
     * 
     * @return str
     */
    public function stringList( $values ) 
    {                
        $strResult = '';
        if ( is_array( $values ) ) {
            $lastItem = count( $values ) > 1 ? ' and ' . array_pop( $values ) : '';
            $strResult= implode( ', ', $values ) . $lastItem;
        }
        return $strResult;
    }
}

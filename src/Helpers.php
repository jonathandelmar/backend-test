<?php

namespace Finder;

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
            $value = sprintf('$%s', number_format($value, $decimals));
        }
        return $value;
    }

    public function date($data, $format = 'Y-m-d')
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
}

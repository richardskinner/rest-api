<?php

namespace Framework\Services;

class BinaryConverter
{
    public function translate($binary)
    {
        $output = '';
        $input = str_replace(' ', '', $binary);

        for($i=0; $i < strlen($input); $i+=8) {
          $output .= chr(intval(substr($input, $i, 8), 2));
        }

        return $output;
    }
}

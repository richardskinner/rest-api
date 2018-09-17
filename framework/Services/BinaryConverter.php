<?php

namespace Framework\Services;

class BinaryConverter
{
    public function translate($binary)
    {
        $output = '';
        $binary = str_replace(' ', '', $binary);

        if (!is_binarystring($binary)) {
            return false;
        }

        for($i=0; $i < strlen($binary); $i+=8) {
          $output .= chr(intval(substr($binary, $i, 8), 2));
        }

        return $output;
    }
}

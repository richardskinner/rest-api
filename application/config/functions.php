<?php
if (!function_exists('getallheaders')) {
    function getallheaders()
    {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

if (!function_exists('is_binarystring')) {
    function is_binarystring($str)
    {
        # Check if entered string is actually a binary string ( fit for conversion )
        # so, length dividable by 8 and only 1's and 0's.
        if (is_int(strlen($str) / 8)) {
            for ($i = 0; $i < strlen($str); $i++) {
                $char = substr($str, $i, 1);
                if (($char !== chr(48)) && ($char !== chr(49))) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}

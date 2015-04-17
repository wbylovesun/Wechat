<?php
namespace Wechat\Client;

class Json
{
    public static function encode($array)
    {
        if (version_compare(PHP_VERSION, '5.4.0', '>')) {
            return json_encode($array, JSON_UNESCAPED_UNICODE);
        }
        
        if (!is_array($array)) return false;
        $associative = count(array_diff(array_keys($array), array_keys(array_keys($array))));
        if ($associative) {   
            $construct = array();
            foreach ($array as $key => $value) {
                if (is_numeric($key)) {
                    $key = "key_$key";
                }
                $key = '"' . addslashes($key) . '"';
                if (is_array($value)) {
                    $value = static::encode( $value );
                } elseif (!is_numeric($value) || is_string($value)) {
                    $value = '"' . addslashes($value) . '"';
                }
                $construct[] = "$key:$value";
            }
            $result = "{" . implode(", ", $construct) . "}";
        } else {
            $construct = array();
            foreach ($array as $value) {
                if (is_array($value)) {
                    $value = static::encode($value);
                } elseif (!is_numeric( $value ) || is_string($value)) {
                    $value = '"' . addslashes($value) . '"';
                }
                $construct[] = $value;
            }
            $result = "[" . implode(", ", $construct) . "]";
        }
        return $result;
    }
}
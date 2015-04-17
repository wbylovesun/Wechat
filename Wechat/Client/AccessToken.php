<?php
namespace Wechat\Client;

class AccessToken
{
    const ACCESS_TOKEN_URL = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';
    
    private static $expires = 0;
    
    public static function isExpired()
    {
        return self::$expires < time();
    }
    
    public static function get($appid, $secret)
    {
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $curl->get(
            sprintf(self::ACCESS_TOKEN_URL, $appid, $secret),
            true
        );
        $result = @json_decode($result);
        if (!$result) return false;
        self::$expires = time() + $result->expires_in;
        return $result->access_token;
    }
}
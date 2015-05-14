<?php
namespace Wechat\Request\OpenUser;

class User
{
    private $openid         = null;
    private $nickname       = '';
    private $sex            = 0;
    private $language       = 'zh_CN';
    private $city           = '';
    private $province       = '';
    private $country        = '';
    private $headimgurl     = null;
    private $subscribe      = 0;
    private $subscribe_time = 0;
    
    private function __construct()
    {
    }
    
    public static function init($json)
    {
        $self = new self();
        if (!$json instanceof stdClass && is_string($json)) {
            $user = json_decode($json);
        } else {
            $user = $json;
        }
        foreach ($user as $key => $value) {
            if (property_exists($self, $key)) {
                $self->$key = $value;
            }
        }
        return $self;
    }
    
    public function hasSubscribed()
    {
        return (bool) $this->subscribe;
    }
    
    public function getOpenId()
    {
        return $this->openid;
    }
    
    public function getNickname()
    {
        return $this->nickname;
    }
    
    public function getGender()
    {
        return $this->sex;
    }
    
    public function getLanguage()
    {
        return $this->language;
    }
    
    public function getCity()
    {
        return $this->city;
    }
    
    public function getProvince()
    {
        return $this->province;
    }
    
    public function getCountry()
    {
        return $this->country;
    }
    
    public function getLocation($separator=' ')
    {
        return $this->country . $separator . $this->province . $separator . $this->city;
    }
    
    public function getHeadImgUrl()
    {
        return $this->headimgurl;
    }
    
    public function getSubscribeTime()
    {
        return $this->subscribe_time;
    }
}
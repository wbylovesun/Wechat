<?php
namespace Wechat\Client\OpenUser;

use Wechat\Client\Curl;
use Wechat\Client\Json;

class OpenUser extends AbstractOpenUser
{
    const OPENUESR_INFO_URL   = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=%s&openid=%s';
    const OPENUESR_LIST_URL   = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=%s';
    const OPENUESR_UPDATE_URL = 'https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=%s';
    
    public function getinfo($openid)
    {
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult(
            $curl->get(
                sprintf(self::OPENUESR_INFO_URL, $this->getAccessToken(), $openid),
                true
            )
        );
        return $result === false ? false : User::init($result);
    }
    
    public function getlist($next_openid='')
    {
        $url = sprintf(self::OPENUESR_LIST_URL, $this->getAccessToken());
        if ($next_openid) {
            $url .= sprintf('&next_openid=%s', $next_openid);
        }
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult($curl->get($url, true));
        return $result === false ? false : Follower::init($result);
    }
    
    public function update($openid, $togroup)
    {
        // {"openid":"oDF3iYx0ro3_7jD4HFRDfrjdCM58","to_groupid":108}
        $json = Json::encode(array('openid' => $openid, 'to_groupid' => $togroup));
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult(
            $curl->post(
                sprintf(self::OPENUESR_UPDATE_URL, $this->getAccessToken()),
                $json,
                true
            )
        );
        return (bool) $result;
    }
}

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

class Follower
{
    private $total;
    private $count;
    private $data;
    private $next_openid;
    
    private function __construct()
    {
    }
    
    public static function init($json)
    {
        $self = new self();
        if (!$json instanceof stdClass && is_string($json)) {
            $follower = json_decode($json);
        } else {
            $follower = $json;
        }
        $self->total = $follower->total;
        $self->count = $follower->count;
        $self->data  = $follower->data->openid;
        $self->next_openid = $follower->next_openid;
        return $self;
    }
    
    public function getTotal()
    {
        return $this->total;
    }
    
    public function getCount()
    {
        return $this->count;
    }
    
    public function getList()
    {
        return $this->data;
    }
    
    public function getNextOpenId()
    {
        return $this->next_openid;
    }
}
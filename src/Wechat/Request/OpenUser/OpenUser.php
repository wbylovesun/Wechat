<?php
namespace Wechat\Request\OpenUser;

use Wechat\Client\Curl;
use Wechat\Client\Json;

class OpenUser extends AbstractOpenUser
{
    const OPENUESR_INFO_URL   = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=%s&openid=%s';
    const OPENUESR_LIST_URL   = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=%s';
    const OPENUESR_UPDATE_URL = 'https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=%s';
    const OPENUESR_GROUP_URL  = 'https://api.weixin.qq.com/cgi-bin/groups/getid?access_token=%s';
    const OPENUESR_BATCHUPDATE_URL  = 'https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate?access_token=%s';
    const OPENUESR_UPDATEREMARK_URL = 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=%s';
    
    public function getInfo($openid)
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
    
    public function getList($next_openid = '')
    {
        $url = sprintf(self::OPENUESR_LIST_URL, $this->getAccessToken());
        if ($next_openid) {
            $url .= sprintf('&next_openid=%s', $next_openid);
        }
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult($curl->get($url, true));
        return $result === false ? false : Follower::init($result);
    }
    
    public function moveGroup($openid, $togroup)
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
    
    public function getGroup($openid)
    {
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult(
            $curl->post(
                sprintf(self::OPENUESR_INFO_URL, $this->getAccessToken()),
                Json::encode(['openid' => $openid]),
                true
            )
        );
        return $result === false ? false : $result['groupid'];
    }
    
    public function batchMoveGroup(array $openid, $togroup)
    {
        // {"openid_list":["oDF3iYx0ro3_7jD4HFRDfrjdCM58"],"to_groupid":108}
        $json = Json::encode(array('openid_list' => $openid, 'to_groupid' => $togroup));
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult(
            $curl->post(
                sprintf(self::OPENUESR_BATCHUPDATE_URL, $this->getAccessToken()),
                $json,
                true
            )
        );
        return (bool) $result;
    }
    
    public function updateRemark($openid, $remark)
    {
        // {"openid":"oDF3iYx0ro3_7jD4HFRDfrjdCM58","remark":"pangzi"}
        $json = Json::encode(array('openid' => $openid, 'remark' => $remark));
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult(
            $curl->post(
                sprintf(self::OPENUESR_UPDATEREMARK_URL, $this->getAccessToken()),
                $json,
                true
            )
        );
        return (bool) $result;
    }
}
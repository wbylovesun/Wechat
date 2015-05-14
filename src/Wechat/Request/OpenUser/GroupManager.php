<?php
namespace Wechat\Request\OpenUser;

use Wechat\Client\Curl;
use Wechat\Client\Json;

class GroupManager extends AbstractOpenUser
{
    const GROUP_GET_URL    = 'https://api.weixin.qq.com/cgi-bin/groups/get?access_token=%s';
    const GROUP_CREATE_URL = 'https://api.weixin.qq.com/cgi-bin/groups/create?access_token=%s';
    const GROUP_UPDATE_URL = 'https://api.weixin.qq.com/cgi-bin/groups/update?access_token=%s';
    const GROUP_DELETE_URL = 'https://api.weixin.qq.com/cgi-bin/groups/delete?access_token=%s';
    
    public function get()
    {
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult(
            $curl->get(
                sprintf(self::GROUP_GET_URL, $this->getAccessToken()),
                true
            )
        );
        return $result === false ? false : $result->groups;
    }
    
    public function create($name)
    {
        if (strlen($name) > 30) {
            return false;
        }
        $json = Json::encode(array('group' => array('name' => $name)));
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult(
            $curl->post(
                sprintf(self::GROUP_CREATE_URL, $this->getAccessToken()),
                $json,
                true
            )
        );
        return $result === false ? false : $result->group->id;
    }
    
    public function update($id, $name)
    {
        if (strlen($name) > 30) return false;
        $json = Json::encode(array('group' => array('id' => $id, 'name' => $name)));
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult(
            $curl->post(
                sprintf(self::GROUP_CREATE_URL, $this->getAccessToken()),
                $json,
                true
            )
        );
        return $result === false ? false : true;
    }
    
    public function delete($id)
    {
        $json = Json::encode(array('group' => array('id' => $id)));
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $this->processResult(
            $curl->post(
                sprintf(self::GROUP_DELETE_URL, $this->getAccessToken()),
                $json,
                true
            )
        );
        return $result === false ? false : true;
    }
}
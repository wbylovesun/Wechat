<?php
namespace Wechat\Client\CustomMenu;

use Wechat\Client\Curl;
use Wechat\Client\Json;

class CustomMenu
{
    const CUSTOM_MENU_CREATE_URL = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s';
    const CUSTOM_MENU_GET_URL    = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=%s';
    const CUSTOM_MENU_DELETE_URL = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=%s';
    
    private $access_token = null;
    private $buttons      = array();
    private $errcode      = null;
    private $errmsg       = null;
    
    public function __construct()
    {
    }
    
    public function addButton(AbstractButton $button)
    {
        $this->buttons[] = $button;
        return $this;
    }
    
    public function toJson()
    {
        print_r($this->buttons);
        $arr = array('button' => array());
        foreach ($this->buttons as $button) {
            $arr['button'][] = $button->toArray();
        }
        return Json::encode($arr);
    }
    
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
        return $this;
    }
    
    public function getAccessToken()
    {
        return $this->access_token;
    }
    
    private function setErrCode($errcode)
    {
        $this->errcode = $errcode;
        return $this;
    }
    
    public function getErrCode()
    {
        return $this->errcode;
    }
    
    private function setErrMsg($errmsg)
    {
        $this->errmsg = $errmsg;
        return $this;
    }
    
    public function getErrMsg()
    {
        return $this->errmsg;
    }
    
    public function create($json)
    {
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $curl->post(
            sprintf(self::CUSTOM_MENU_CREATE_URL, $this->getAccessToken()),
            $json,
            true
        );
        $result = json_decode($result);
        if ($result->errcode != 0) {
            $this->setErrCode($result->errcode)->setErrMsg($result->errmsg);
            return false;
        }
        return true;
    }
    
    public function query()
    {
        $curl = new Curl(array(CURLOPT_HEADER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $curl->get(
            sprintf(self::CUSTOM_MENU_GET_URL, $this->getAccessToken()),
            true
        );
        $result = json_decode($result);
        if ($result->errcode != 0) {
            $this->setErrCode($result->errcode)->setErrMsg($result->errmsg);
            return false;
        }
        return $result;
    }
    
    public function delete()
    {
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $curl->get(
            sprintf(self::CUSTOM_MENU_DELETE_URL, $this->getAccessToken()),
            true
        );
        $result = json_decode($result);
        if ($result->errcode != 0) {
            $this->setErrCode($result->errcode)->setErrMsg($result->errmsg);
            return false;
        }
        return true;
    }
}
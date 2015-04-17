<?php
namespace Wechat\Response\Active;

use Wechat\Client\Curl;
use Wechat\Client\Json;

abstract class AbstractMessage
{
    const ACTIVE_MESSAGE_URL   = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=%s';
    
    protected $access_token    = null;
    protected $messageReceiver = null;
    protected $msgType         = null;
    
    private   $errcode         = null;
    private   $errmsg          = null;
    
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
        return $this;
    }
    
    public function getAccessToken()
    {
        return $this->access_token;
    }
    
    public function setMessageReceiver($messageReceiver)
    {
        $this->messageReceiver = $messageReceiver;
        return $this;
    }
    
    public function getMessageReceiver()
    {
        return $this->messageReceiver;
    }
    
    public function getMsgType()
    {
        return $this->msgType;
    }
    
    public function sendRequest()
    {
        $json = Json::encode($this->buildJson($this->initJson()));
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $curl->post(
            sprintf(self::ACTIVE_MESSAGE_URL, $this->getAccessToken()),
            $json,
            true
        );
        $result = @json_decode($result);
        if (!$result) {
            $this->setErrCode(-1)->setErrMsg('Invalid Json Response from WeiXin server');
            return false;
        }
        if (isset($result->errcode) && $result->errcode != 0) {
            $this->setErrCode($result->errcode)->setErrMsg($result->errmsg);
            return false;
        } 
        return $result;
    }
    
    private function initJson()
    {   
        return array(
            'touser'  => $this->getMessageReceiver(),
            'msgtype' => $this->msgType,
        );
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
    
    abstract protected function buildJson(array $basic);
}
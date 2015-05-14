<?php
namespace Wechat\Request\OpenUser;

abstract class AbstractOpenUser
{
    private $access_token = null;
    private $errcode      = null;
    private $errmsg       = null;
    
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
    
    protected function processResult($result)
    {
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
}
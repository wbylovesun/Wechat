<?php
namespace Wechat\Client;

use Exception;

class QrCode
{
    const TICKET_URL = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s';
    const QRCODE_URL = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=%s';
    
    private $errcode = null;
    private $errmsg  = null;
    
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
        return $this;
    }
    
    public function getAccessToken()
    {
        return $this->access_token;
    }
    
    public function createTemporaryTicket($sceneid, $expires=1800)
    {
        //{"expire_seconds": 1800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}
        $expires = $expires > 1800 ? 1800 : abs($expires);
        if (!is_int($sceneid)) {
            throw new Exception("Invalid Scene Id, it should be an integer");
        }
        $sceneid = abs($sceneid);
        $json = Json::encode(array('expire_seconds' => $expires, 'action_name' => 'QR_SCENE', 'action_info' => array('scene' => array('scene_id' => $sceneid))));
        return $this->createTicket($json);
    }
    
    public function createPermanentTicket($sceneid)
    {
        //{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}
        if (!is_int($sceneid)) {
            throw new Exception("Invalid Scene Id, it should be an integer between 0 and 1000");
        }
        $sceneid = abs($sceneid);
        if ($sceneid < 0 || $sceneid > 1000) {
            throw new Exception("Invalid Scene Id, it should be an integer between 0 and 1000");
        }
        $json = Json::encode(array('action_name' => 'QR_LIMIT_SCENE', 'action_info' => array('scene' => array('scene_id' => $sceneid))));
        return $this->createTicket($json);
    }
    
    public function getQrCodeImage($ticket, $writeto=null)
    {
        if ($writeto) {
            if (is_dir($writeto)) {
                $savefile = rtrim($writeto, '/\\') . DIRECTORY_SEPARATOR . md5($ticket) . '.jpg';
            } else {
                $savefile = $writeto;
                $filename = basename($savefile);
                $writeto  = dirname($savefile);
            }
            if (is_dir($writeto) && !is_writable($writeto)) {
                throw new Exception("Directory $writeto is not writable");
            }
        } else {
            $savefile = 'PHP://STDOUT';
        }
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $curl->get(sprintf(self::QRCODE_URL, urlencode($ticket)), true);
        if ($curl->getHttpCode() != 200) return false;
        file_put_contents($savefile, $result);
        return basename($savefile);
    }
    
    private function createTicket($json)
    {
        $curl = new Curl(array(CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false));
        $result = $curl->post(
            sprintf(self::TICKET_URL, $this->getAccessToken()),
            $json,
            true
        );
        $result = json_decode($result);
        if (property_exists($result, 'errcode') && $result->errcode != 0) {
            $this->setErrCode($result->errcode)->setErrMsg($result->errmsg);
            return false;
        }
        return $result->ticket;
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
}
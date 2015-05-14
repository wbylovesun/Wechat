<?php
namespace Wechat\Request\MultiMedia;

use Wechat\Client\Curl;

abstract class AbstractMultiMedia
{
    const MM_DOWNLOAD_URL   = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=%s&media_id=%s';
    const MM_UPLOAD_URL     = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=%s&type=%s';
    
    protected $access_token = null;
    protected $mediafile    = null;
    
    private   $errcode      = null;
    private   $errmsg       = null;
    
    abstract public function getType();
    
    public function __construct($access_token=null)
    {
        if ($access_token) {
            $this->setAccessToken($access_token);
        }
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
    
    public function setMediaFile($file)
    {
        if (!file_exists($file) || !is_readable($file)) {
            throw new Exception("$file not found, or isn't readable");
        }
        $this->mediafile = $file;
        return $this;
    }
    
    public function getMediaFile()
    {
        return $this->mediafile;
    }
    
    public function upload()
    {
        $curl = new Curl();
        $result = $curl->upload(
            sprintf(self::MM_UPLOAD_URL, $this->getAccessToken(), $this->getType()),
            array('media' => '@' . $this->getMediaFile()),
            true
        );
        $result = @json_decode($result);
        if (is_object($result)) {
            if (property_exists($result, 'errcode')) {
                $this->setErrCode($result->errcode)->setErrMsg($result->errmsg);
                return false;
            } elseif (isset($result->media_id)) {
                return $result;
            }
        }
        return false;
    }
    
    public function download($mediaId, $writeto = null)
    {
        if ($writeto) {
            if (!is_writable($writeto)) {
                throw new Exception($writeto . " isn't writable");
            }
            $writeto = rtrim($writeto, '\\/');
        }
        $curl = new Curl(array(CURLOPT_HEADER => true));
        $result = $curl->download(
            sprintf(self::MM_DOWNLOAD_URL, $this->getAccessToken(), $mediaId)
        );
        $result = explode("\r\n\r\n", $result);
        $header = $result[0]; $body = $result[1];
        $result = @json_decode($body);
        if (is_object($result) && property_exists($result, 'errcode')) {
            $this->setErrCode($result->errcode)->setErrMsg($result->errmsg);
            return false;
        }
        $attachment = $this->parseHeaders($header);
        if ($writeto) {
            if (!$attachment) {
                $this->setErrCode(-1)->setErrMsg('No attachment info in HEADER');
                return false;
            }
            file_put_contents($writeto . DIRECTORY_SEPARATOR . $attachment, $body);
        }
        return $attachment;
    }
    
    private function parseHeaders($header)
    {
        $attachment = null;
        if (preg_match('/attachment; filename="(.*)"\r\n/', $header, $matches)) {
            $attachment = $matches[1];
        }
        return $attachment;
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
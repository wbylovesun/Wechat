<?php
namespace Wechat\Request\Message;

class Voice extends AbstractMessage
{
    protected $format      = null;
    protected $mediaId     = null;
    protected $recognition = null;
    
    protected function setFormat($format)
    {
        $this->format = (string) $format;
        return $this;
    }
    
    public function getFormat()
    {
        return $this->format;
    }
    
    protected function setMediaId($mediaId)
    {
        $this->mediaId = (string) $mediaId;
        return $this;
    }
    
    public function getMediaId()
    {
        return $this->mediaId;
    }
    
    protected function setRecognition($recognition)
    {
        $this->recognition = (string) $recognition;
        return $this;
    }
    
    public function getRecognition()
    {
        return $this->recognition;
    }
    
    protected function setRequestParam($param, $element)
    {
        switch ($param) {
            case 'ToUserName':
                $this->setServiceProvider($element);
            break;
            case 'FromUserName':
                $this->setMessageTrigger($element);
            break;
            case 'CreateTime':
                $this->setCreateTime($element);
            break;
            case 'MsgType':
                $this->setMsgType($element);
            break;
            case 'Format':
                $this->setFormat($element);
            break;
            case 'MediaId':
                $this->setMediaId($element);
            break;
            case 'Recognition':
                $this->setRecognition($element);
            break;
            case 'MsgId':
                $this->setMessageId($element);
            break;
        }
    }
}
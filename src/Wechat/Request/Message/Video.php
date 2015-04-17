<?php
namespace Wechat\Request\Message;

class Video extends AbstractMessage
{
    protected $thumbMediaId = null;
    protected $mediaId      = null;
    
    protected function setThumbMediaId($thumbMediaId)
    {
        $this->thumbMediaId = (string) $thumbMediaId;
        return $this;
    }
    
    public function getThumbMediaId()
    {
        return $this->thumbMediaId;
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
            case 'ThumbMediaId':
                $this->setThumbMediaId($element);
            break;
            case 'MediaId':
                $this->setMediaId($element);
            break;
            case 'MsgId':
                $this->setMessageId($element);
            break;
        }
    }
}
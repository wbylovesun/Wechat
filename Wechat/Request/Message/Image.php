<?php
namespace Wechat\Request\Message;

class Image extends AbstractMessage
{
    protected $picurl  = null;
    protected $mediaId = null;
    
    protected function setPicUrl($picurl)
    {
        $this->picurl = (string) $PicUrl;
        return $this;
    }
    
    public function getPicUrl()
    {
        return $this->picurl;
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
            case 'PicUrl':
                $this->setPicUrl($element);
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
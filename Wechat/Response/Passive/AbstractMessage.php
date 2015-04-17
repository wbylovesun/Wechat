<?php
namespace Wechat\Response\Passive;

abstract class AbstractMessage implements MessageInterface
{
    protected $xml = null;
    
    protected $messageReceiver = null;
    protected $messageSender   = null;
    protected $createTime      = null;
    protected $msgType         = null;
    
    public function __construct()
    {
        $this->initXml();
        $this->setCreateTime();
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
    
    public function setMessageSender($messageSender)
    {
        $this->messageSender = $messageSender;
        return $this;
    }
    
    public function getMessageSender()
    {
        return $this->messageSender;
    }
    
    public function setCreateTime($ts=null)
    {
        if (is_int($ts))
            $this->createTime = $ts;
        else
            $this->createTime = time();
        return $this;
    }
    
    public function getCreateTime()
    {
        return $this->createTime;
    }
    
    public function getMsgType()
    {
        return $this->msgType;
    }
    
    public function generateXml()
    {
        return '';
    }
    
    abstract protected function initXml();
}
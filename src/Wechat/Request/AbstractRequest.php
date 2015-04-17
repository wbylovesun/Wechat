<?php
namespace Wechat\Request;

use SimpleXMLElement;

abstract class AbstractRequest
{
    protected $root         = null;
    
    protected $serviceProvider = null;
    protected $messageTrigger  = null;
    protected $createTime      = null;
    protected $msgType         = null;
    
    public function __construct(SimpleXMLElement $root)
    {
        $this->root = $root;
        $this->setRequestParams($this->root);
    }
    
    public function getEventXml()
    {
        return ($this->root instanceof SimpleXMLElement) ? $this->root->asXML() : '';
    }
    
    protected function setServiceProvider($serviceProvider)
    {
        $this->serviceProvider = (string) $serviceProvider;
        return $this;
    }
    
    public function getServiceProvider()
    {
        return $this->serviceProvider;
    }
    
    protected function setMessageTrigger($messageTrigger)
    {
        $this->messageTrigger = (string) $messageTrigger;
        return $this;
    }
    
    public function getMessageTrigger()
    {
        return $this->messageTrigger;
    }
    
    protected function setCreateTime($createTime)
    {
        $this->createTime = (int) $createTime;
        return $this;
    }
    
    public function getCreateTime()
    {
        return $this->createTime;
    }
    
    protected function setMsgType($msgType)
    {
        $this->msgType = (string) $msgType;
        return $this;
    }
    
    public function getMsgType()
    {
        return $this->msgType;
    }
    
    protected function setRequestParams(SimpleXMLElement $params)
    {
        if ($params instanceof SimpleXMLElement)
        {
            foreach ($params as $param => $element) {
                $this->setRequestParam($param, $element);
            }
        }
    }
    
    abstract protected function setRequestParam($param, $element);
}
<?php
namespace Wechat\Request;

use SimpleXMLElement;

abstract class AbstractRequest
{
    const EVENT_KEY = 'event';
    
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
    
    public function isEvent()
    {
        return $this->msgType === self::EVENT_KEY;
    }
    
    public function __set($name, $value)
    {
        if (isset($this->$name)) {
            $this->$name = $value;
            return true;
        }
        $method = 'set' . ucfirst($name);
        if (method_exists($this, $method)) {
            $this->$method($value);
            return true;
        }
        throw new \LogicException('Unknown property "' . $name . '"');
    }
    
    protected function setRequestParams(SimpleXMLElement $params)
    {
        $arrFields = $this->fields();
        if ($params instanceof SimpleXMLElement) {
            foreach ($params as $param => $element) {
                if (method_exists($this, $arrFields[$param])) {
                    $method = $arrFields[$param];
                    $this->$method($element);
                } elseif (property_exists($this, $param)) {
                    $this->$param = $element;
                }
            }
        }
    }
    
    // Used for initialize $arrFieldMappers or other initialization work.
    protected function fields()
    {
        return [
            'ToUserName'   => 'setServiceProvider',
            'FromUserName' => 'setMessageTrigger',
            'CreateTime'   => 'setCreateTime',
            'MsgType'      => 'setMsgType',
        ];
    }
}
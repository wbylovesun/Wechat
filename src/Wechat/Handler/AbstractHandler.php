<?php
namespace Wechat\Handler;

use Wechat\Request\BaseMessage;
use Wechat\Request\Event\AbstractEvent;
use Wechat\Request\Message\AbstractMessage;

abstract class AbstractHandler implements HandlerInterface
{
    protected $arrEventHandlerMapper = [];
    protected $arrMessageHandlerMapper = [];
    
    abstract public function handle(BaseMessage $request);
    
    public function __construct()
    {
        $this->arrEventHandlerMapper = [
            'subscribe'   => [$this, 'handleSubscribe'],
            'unsubscribe' => [$this, 'handleUnSubscribe'],
            'scan'        => [$this, 'handleScan'],
            'location'    => [$this, 'handleLocationEvent'],
            'click'       => [$this, 'handleClick'],
        ];
        $this->arrMessageHandlerMapper = [
            'text'        => [$this, 'handleText'],
            'image'       => [$this, 'handleImage'],
            'link'        => [$this, 'handleLink'],
            'video'       => [$this, 'handleVideo'],
            'voice'       => [$this, 'handleAudio'],
            'location'    => [$this, 'handleLocationMessage'],
        ];
    }
    
    public function setEventHandleMapper($mapper)
    {
        foreach ($mapper as $event => $handler) {
            if (!is_callable($handler)) continue;
            $this->arrEventHandlerMapper[$event] = $handler;
        }
        return $this;
    }
    
    public function setMessageHandlerMapper($mapper)
    {
        foreach ($mapper as $msgType => $handler) {
            if (!is_callable($handler)) continue;
            $this->arrMessageHandlerMapper[$msgType] = $handler;
        }
        return $this;
    }
    
    protected function hasHandler(BaseMessage $request)
    {
        $type = $request->getMsgType();
        $arrHandlerMapper = $this->getHandlerMapper($request);
        return isset($arrHandlerMapper[$type]) && is_callable($arrHandlerMapper[$type]);
    }
    
    protected function callHandler(BaseMessage $request)
    {
        $type = $request->getMsgType();
        $arrHandlerMapper = $this->getHandlerMapper($request);
        return call_user_func_array($arrHandlerMapper[$type], [$request]);
    }
    
    private function getHandlerMapper(BaseMessage $request)
    {
        $type = $request->getMsgType();
        if ($request->isEvent()) {
            $arrHandlerMapper = $this->arrEventHandlerMapper;
        } else {
            $arrHandlerMapper = $this->arrMessageHandlerMapper;
        }
        return $arrHandlerMapper;
    }
    
    public function __call($method, $args)
    {
        if (strncasecmp($method, 'handle', 6) !== 0) {
            throw new \LogicException('Unknown method.');
        }
        echo 'OK';
    }
}
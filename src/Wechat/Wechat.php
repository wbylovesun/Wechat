<?php
namespace Wechat;

use Wechat\Request\MessageFactory as Message;
use Wechat\Handler\HandlerInterface;
use Wechat\Handler\Handler;

class Wechat
{
    protected $handler = null;
    
    public function handle()
    {
        $message = Message::create();
        $this->handler->handle($message);
    }
    
    public function getHandler()
    {
        if (!$this->handler) {
            $this->handler = $this->setHandler(new Handler());
        }
        return $this->handler;
    }
    
    public function setHandler(HandlerInterface $handler)
    {
        $this->handler = $handler;
        return $this;
    }
}
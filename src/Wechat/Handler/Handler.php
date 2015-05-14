<?php
namespace Wechat\Handler;

use Wechat\Request\BaseMessage;

class Handler extends AbstractHandler
{
    public function handle(BaseMessage $event)
    {
        if ($this->hasHandler($event)) {
            return $this->callHandler($event);
        } else {
            // Unknown Event
            echo 'OK';
        }
    }
}

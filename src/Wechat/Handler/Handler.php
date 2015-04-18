<?php
namespace Wechat\Handler;

class Handler extends AbstractHandler
{
    public function handle(AbstractRequest $event)
    {
        if ($this->hasHandler($event)) {
            return $this->callHandler($event);
        } else {
            // Unknown Event
            echo 'OK';
        }
    }
}

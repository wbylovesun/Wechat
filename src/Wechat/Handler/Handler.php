<?php
namespace Wechat\Handler;

use Wechat\Request\AbstractRequest;

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

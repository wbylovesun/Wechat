<?php
namespace Wechat\Handler;

use Wechat\Request\AbstractRequest;

class HandlerInterface
{
    public function handle(AbstractRequest $request);
}
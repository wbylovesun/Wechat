<?php
namespace Wechat\Handler;

use Wechat\Request\BaseMessage;

interface HandlerInterface
{
    public function handle(BaseMessage $request);
}
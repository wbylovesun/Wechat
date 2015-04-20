<?php
namespace Wechat\Handler;

use Wechat\Request\AbstractRequest;

interface HandlerInterface
{
    public function handle(AbstractRequest $request);
}
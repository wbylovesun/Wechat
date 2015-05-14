<?php
namespace Wechat\Request\MultiMedia;

class Voice extends AbstractMultiMedia
{
    public function getType()
    {
        return 'voice';
    }
}
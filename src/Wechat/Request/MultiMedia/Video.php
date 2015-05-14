<?php
namespace Wechat\Request\MultiMedia;

class Video extends AbstractMultiMedia
{
    public function getType()
    {
        return 'video';
    }
}
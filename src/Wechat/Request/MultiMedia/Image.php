<?php
namespace Wechat\Request\MultiMedia;

class Image extends AbstractMultiMedia
{
    public function getType()
    {
        return 'image';
    }
}
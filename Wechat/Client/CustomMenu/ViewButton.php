<?php
namespace Wechat\Client\CustomMenu;

class ViewButton extends AbstractButton
{
    protected $type = 'view';
    private   $url  = null;
    
    public function __construct($name=null, $url=null)
    {
        if ($name) $this->setName($name);
        if ($url)  $this->setUrl($url);
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function toArray()
    {
        $arr = array(
            'type' => $this->type,
            'name' => $this->getName(),
            'url'  => $this->getUrl(),
        );
        return $arr;
    }
}
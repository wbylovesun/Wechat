<?php
namespace Wechat\Request\CustomMenu;

abstract class AbstractButton
{
    protected $type = null;
    protected $name = null;
    
    public function __construct()
    {
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    abstract public function toArray();
}
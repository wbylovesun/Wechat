<?php
namespace Wechat\Request\CustomMenu;

class ClickButton extends AbstractButton
{
    protected $type = 'click';
    private   $key  = null;
    private $subButtons = array();
    
    public function __construct($name=null, $key=null)
    {
        if ($name) $this->setName($name);
        if ($key)  $this->setKey($key);
    }
    
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }
    
    public function getKey()
    {
        return $this->key;
    }
    
    public function addSubButton(AbstractButton $button)
    {
        $this->subButtons[] = $button;
        return $this;
    }
    
    public function toArray()
    {
        $arr = array(
            'type' => $this->type,
            'name' => $this->getName(),
            'key'  => $this->getKey(),
        );
        if ($this->subButtons) {
            unset($arr['type'], $arr['key']);
            $arr['sub_button'] = array();
            foreach ($this->subButtons as $button) {
                $arr['sub_button'][] = $button->toArray();
            }
        }
        return $arr;
    }
}
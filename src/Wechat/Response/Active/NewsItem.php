<?php
namespace Wechat\Response\Active;

use Exception;

class NewsItem
{
    private $title;
    private $description;
    private $picurl;
    private $url;
    
    /**
     * Convenience methods for build in helpers (@see __call):
     *
     * @method \Wechat\Response\Passive\NewsItem setTitle($title)
     * @method \Wechat\Response\Passive\NewsItem getTitle()
     * @method \Wechat\Response\Passive\NewsItem setDescription($description)
     * @method \Wechat\Response\Passive\NewsItem getDescription()
     * @method \Wechat\Response\Passive\NewsItem setPicUrl($picurl)
     * @method \Wechat\Response\Passive\NewsItem getPicUrl()
     * @method \Wechat\Response\Passive\NewsItem setUrl($url)
     * @method \Wechat\Response\Passive\NewsItem getUrl()
     */
        
    public function __call($method, $args)
    {
        $substr = substr($method, 0, 3);
        $mtdstr = strtolower(substr($method, 3));
        if (!in_array($mtdstr, array('title', 'description', 'picurl', 'url'))) {
            throw new Exception("Unknown property: " . $mtdstr);
        }
        if ($substr == 'set') {
            $this->$mtdstr = $args[0];
            return $this;
        } elseif ($substr == 'get') {
            return $this->$mtdstr;
        } else {
            throw new Exception("Unknown method: " . $method);
        }
    }
    
    public function toArray()
    {
        $arrProperties = array();
        if ($this->getTitle()) {
            $arrProperties['title'] = $this->getTitle();
        }
        if ($this->getDescription()) {
            $arrProperties['description'] = $this->getDescription();
        }
        if ($this->getPicUrl()) {
            $arrProperties['picurl'] = $this->getPicUrl();
        }
        if ($this->getUrl()) {
            $arrProperties['url'] = $this->getUrl();
        }
        return $arrProperties;
    }
}
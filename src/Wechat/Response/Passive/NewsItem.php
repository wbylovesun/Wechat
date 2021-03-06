<?php
namespace Wechat\Response\Passive;

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
    
    public function toXML()
    {
        $hasTag = false;
        $tagXml = $partialXml = "";
        if ($this->getTitle()) {
            $hasTag = true;
            $tagXml .= "\t<Title><![CDATA[" . $this->getTitle() . "]]></Title>\n";
        }
        if ($this->getDescription()) {
            $hasTag = true;
            $tagXml .= "\t<Description><![CDATA[" . $this->getDescription() . "]]></Description>\n";
        }
        if ($this->getPicUrl()) {
            $hasTag = true;
            $tagXml .= "\t<PicUrl><![CDATA[" . $this->getPicUrl() . "]]></PicUrl>\n";
        }
        if ($this->getUrl()) {
            $hasTag = true;
            $tagXml .= "\t<Url><![CDATA[" . $this->getUrl() . "]]></Url>\n";
        }
        if ($hasTag) {
            $partialXml = "<item>\n" . $tagXml . "</item>";
        }
        return $partialXml;
    }
}
<?php
namespace Wechat\Response\Passive;

use Exception;

class News extends AbstractMessage
{
    protected $msgType = 'news';
    private $maxArticleCount = 10;
    private $articles        = array();
    
    public function setNewsItems(array $items)
    {
        foreach ($items as $item) {
            if (!$item instanceof NewsItem) continue;
            $this->addNewsItem($item);
        }
        return $this;
    }
    
    public function addNewsItem(NewsItem $item)
    {
        if (count($this->articles) > $this->maxArticleCount) {
            throw new Exception("Count of articles must be litter than " . $this->maxArticleCount);
        }
        $this->articles[] = $item;
        return $this;
    }
    
    public function getNewsItems()
    {
        return $this->articles;
    }
    
    public function generateXml()
    {
        if (!$this->msgType) throw new Exception("Invalid MsgType assigned");
        $articleXml = $this->articlesToXml();
        $xml = sprintf($this->xml,
            $this->getMessageReceiver(),
            $this->getMessageSender(),
            $this->getCreateTime(),
            $this->getMsgType(),
            count($this->articles),
            $articleXml
        );
        return $xml;
    }
    
    protected function initXml()
    {
        $this->xml  = "<xml>\n";
        $this->xml .= "\t<ToUserName><![CDATA[%s]]></ToUserName>\n";
        $this->xml .= "\t<FromUserName><![CDATA[%s]]></FromUserName>\n";
        $this->xml .= "\t<CreateTime>%d</CreateTime>\n";
        $this->xml .= "\t<MsgType><![CDATA[%s]]></MsgType>\n";
        $this->xml .= "\t<ArticleCount><![CDATA[%d]]></ArticleCount>\n";
        $this->xml .= "\t<Articles>\n";
        $this->xml .= "\t%s\n";
        $this->xml .= "\t</Articles>\n";
        $this->xml .= "</xml>";
    }
    
    private function articlesToXml()
    {
        $articleXml = array();
        foreach ($this->articles as $k => $article) {
            $xml = $article->toXML();
            if (!$xml) unset($this->articles[$k]); else $articleXml[] = $xml;
        }
        return implode("\n", $articleXml);
    }
}
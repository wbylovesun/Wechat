<?php
namespace Wechat\Response\Active;

class News extends AbstractMessage
{
    protected $msgType = 'news';
    
    private $articles = array();
    
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
        $this->articles[] = $item;
        return $this;
    }
    
    public function getNewsItems()
    {
        return $this->articles;
    }
    
    protected function buildJson(array $basic)
    {
        $basic['news']['articles'] = array();
        foreach ($this->articles as $article) {
            $item = $article->toArray();
            if (!$item) continue;
            $basic['news']['articles'][] = $item;
        }
        return $basic;
    }
}
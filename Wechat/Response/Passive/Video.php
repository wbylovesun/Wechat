<?php
namespace Wechat\Response\Passive;

class Video extends AbstractMessage
{
    protected $msgType = 'video';
    private $mediaId     = null;
    private $title       = '';
    private $description = '';
    
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        return $this;
    }
    
    public function getMediaId()
    {
        return $this->mediaId;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function generateXml()
    {
        if (!$this->msgType) throw new Exception("Invalid MsgType assigned");
        
        $xml = sprintf($this->xml,
            $this->getMessageReceiver(),
            $this->getMessageSender(),
            $this->getCreateTime(),
            $this->getMsgType(),
            $this->mediaId()
        );
        // build tags content
        $title       = $this->title ? '<Title><![CDATA[' . $this->title . ']]></Title>' : '';
        $description = $this->description ? '<Description><![CDATA[' . $this->description . ']]></Description>' : '';
        // replace tags '{$title$}', '{$description$}'
        $xml = str_replace(array('{$title$}', '{$description$}'), array($title, $description), $xml);
        
        return $xml;
    }
    
    protected function initXml()
    {
        $this->xml  = "<xml>\n";
        $this->xml .= "\t<ToUserName><![CDATA[%s]]></ToUserName>\n";
        $this->xml .= "\t<FromUserName><![CDATA[%s]]></FromUserName>\n";
        $this->xml .= "\t<CreateTime>%d</CreateTime>\n";
        $this->xml .= "\t<MsgType><![CDATA[%s]]></MsgType>\n";
        $this->xml .= "\t<Video>\n";
        $this->xml .= "\t<MediaId><![CDATA[%s]]></MediaId>\n";
        $this->xml .= "{\$title\$}{\$description\$}";
        $this->xml .= "\t</Video>\n";
        $this->xml .= "</xml>";
    }
}
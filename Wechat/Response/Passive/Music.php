<?php
namespace Wechat\Response\Passive;

class Music extends AbstractMessage
{
    protected $msgType = 'music';
    private $image = null;
    
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }
    
    public function getImage()
    {
        return $this->image;
    }
    
    public function generateXml()
    {
        if (!$this->msgType) throw new Exception("Invalid MsgType assigned");
        
        $xml = sprintf($this->xml,
            $this->getMessageReceiver(),
            $this->getMessageSender(),
            $this->getCreateTime(),
            $this->getMsgType(),
            $this->getText()
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
        $this->xml .= "\t<Image>\n";
        $this->xml .= "\t<MediaId><![CDATA[%s]]></MediaId>\n";
        $this->xml .= "\t</Image>\n";
        $this->xml .= "</xml>";
    }
}
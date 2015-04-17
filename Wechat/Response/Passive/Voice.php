<?php
namespace Wechat\Response\Passive;

class Voice extends AbstractMessage
{
    protected $msgType = 'voice';
    private $mediaId = null;
    
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        return $this;
    }
    
    public function getMediaId()
    {
        return $this->mediaId;
    }
    
    public function generateXml()
    {
        if (!$this->msgType) throw new Exception("Invalid MsgType assigned");
        
        $xml = sprintf($this->xml,
            $this->getMessageReceiver(),
            $this->getMessageSender(),
            $this->getCreateTime(),
            $this->getMsgType(),
            $this->getMediaId()
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
        $this->xml .= "\t<Voice>\n";
        $this->xml .= "\t<MediaId><![CDATA[%s]]></MediaId>\n";
        $this->xml .= "\t</Voice>\n";
        $this->xml .= "</xml>";
    }
}
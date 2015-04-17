<?php
namespace Wechat\Response\Passive;

class Text extends AbstractMessage
{
    protected $msgType = 'text';
    private   $content = null;
    
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    public function generateXml()
    {
        if (!$this->msgType) throw new Exception("Invalid MsgType assigned");
        
        $xml = sprintf($this->xml,
            $this->getMessageReceiver(),
            $this->getMessageSender(),
            $this->getCreateTime(),
            $this->getMsgType(),
            $this->getContent()
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
        $this->xml .= "\t<Content><![CDATA[%s]]></Content>\n";
        $this->xml .= "</xml>";
    }
}
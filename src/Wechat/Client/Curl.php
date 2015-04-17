<?php
namespace Wechat\Client;

class Curl
{
    private $ch = null;
    
    public function __construct(array $options=array())
    {
        $this->init($options);
    }
    
    private function init(array $options=array())
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_POST, false);
        if ($options) {
            $this->setOptions($options);
        }
    }
    
    public function setOptions($options)
    {
        if ($options instanceof \Traversable) {
            $options = $options->toArray();
        }
        if (!is_array($options)) {
            throw new \Exception("Invalid options");
        }
        foreach ($options as $k => $option)
        {
            curl_setopt($this->ch, $k, $option);
        }
        return $this;
    }
    
    public function setOption($k, $option)
    {
        curl_setopt($this->ch, $k, $option);
        return $this;
    }
    
    public function get($url, $transfer=false)
    {
        if ($transfer) $this->setOption(CURLOPT_RETURNTRANSFER, true);
        $result = $this->setOption(CURLOPT_URL, $url)
                       ->execute();
        return $result;
    }
    
    public function post($url, $data, $transfer=false)
    {
        if ($transfer) $this->setOption(CURLOPT_RETURNTRANSFER, true);
        $result = $this->setOption(CURLOPT_URL, $url)
                       ->setOption(CURLOPT_POST, true)
                       ->setOption(CURLOPT_POSTFIELDS, $data)
                       ->execute();
        return $result;
    }
    
    public function upload($url, $data, $transfer=false)
    {
        if ($transfer) $this->setOption(CURLOPT_RETURNTRANSFER, true);
        $result = $this->setOption(CURLOPT_URL, $url)
                       ->setOption(CURLOPT_POST, true)
                       ->setOption(CURLOPT_POSTFIELDS, $data)
                       ->execute();
        return $result;
    }
    
    public function download($url)
    {
        return $this->get($url, true);
    }
    
    public function getHttpCode()
    {
        return curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
    }
    
    private function execute()
    {
        $result = curl_exec($this->ch);
        return $result;
    }
    
    public function __destruct()
    {
        if ($this->ch) curl_close($this->ch);
    }
}
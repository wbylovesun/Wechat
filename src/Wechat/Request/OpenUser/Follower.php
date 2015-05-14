<?php
namespace Wechat\Request\OpenUser;

class Follower
{
    private $total;
    private $count;
    private $data;
    private $next_openid;
    
    private function __construct()
    {
    }
    
    public static function init($json)
    {
        $self = new self();
        if (!$json instanceof stdClass && is_string($json)) {
            $follower = json_decode($json);
        } else {
            $follower = $json;
        }
        $self->total = $follower->total;
        $self->count = $follower->count;
        $self->data  = $follower->data->openid;
        $self->next_openid = $follower->next_openid;
        return $self;
    }
    
    public function getTotal()
    {
        return $this->total;
    }
    
    public function getCount()
    {
        return $this->count;
    }
    
    public function getList()
    {
        return $this->data;
    }
    
    public function getNextOpenId()
    {
        return $this->next_openid;
    }
}
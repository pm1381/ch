<?php
namespace Classes;

class Cookie 
{
    protected $name;
    protected $content;
    protected $expire;

    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    public function setContent($value)
    {
        $this->content = $value;
        return $this;
    }

    public function setExpire($value)
    {
        $this->expire = $value;
        return $this;
    }

    public function add()
    {
        $_COOKIE[$this->name] = $this->content;
        setcookie($this->name, $this->content, strtotime($this->expire), '/');
        return $this;
    }

    public function remove()
    {
        setcookie($this->name, "", time()-3600, '/');
    }

    public function get()
    {
        $content = null;
        if(isset($_COOKIE[$this->name])) {
            $content = $_COOKIE[$this->name];
        }
        return $content;
    }
}
?>

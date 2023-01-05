<?php
namespace App\Entities;

class Insurer extends Entity {
    private string $name;
    private int $active = 1;
    private string $decription;

    /**
     * Get the value of decription
     */ 
    public function getDecription()
    {
        return $this->decription;
    }

    /**
     * Set the value of decription
     *
     * @return  self
     */ 
    public function setDecription($decription)
    {
        $this->decription = $decription;
        return $this;
    }

    /**
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
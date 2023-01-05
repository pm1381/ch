<?php
namespace App\Entities;

class FireInsurance extends PropertyInsurance {
    private string $name;
    private int $fireId;

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

    /**
     * Get the value of fireId
     */ 
    public function getFireId()
    {
        return $this->fireId;
    }

    /**
     * Set the value of fireId
     *
     * @return  self
     */ 
    public function setFireId($fireId)
    {
        $this->fireId = $fireId;
        return $this;
    }
}
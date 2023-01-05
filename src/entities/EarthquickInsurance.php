<?php
namespace App\Entities;

class EarthquickInsurance extends PropertyInsurance {
    private string $name;
    private int $earthId; // earth table id

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
     * Get the value of earthId
     */ 
    public function getEarthId()
    {
        return $this->earthId;
    }

    /**
     * Set the value of earthId
     *
     * @return  self
     */
    public function setEarthId($earthId)
    {
        $this->earthId = $earthId;
        return $this;
    }
}
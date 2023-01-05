<?php
namespace App\Entities;

class EarthquickInsurance extends PropertyInsurance {
    private string $name;
    private Insurance $insurance;

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
     * Get the value of insurance
     */ 
    public function getInsurance()
    {
        return $this->insurance;
    }

    /**
     * Set the value of insurance
     *
     * @return  self
     */ 
    public function setInsurance($insurance)
    {
        $this->insurance = $insurance;
        return $this;
    }
}
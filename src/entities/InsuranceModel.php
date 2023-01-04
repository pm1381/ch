<?php
namespace App\Entities;

class InsuranceModel extends Entity {
    private string $name;

    /**
     * Get the value of value
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */ 
    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }
}
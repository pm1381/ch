<?php
namespace App\Entities;

class AgeRange extends Entity {
    private int $value;

    /**
     * Get the value of value
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */ 
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
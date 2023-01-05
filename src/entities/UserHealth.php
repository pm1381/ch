<?php
namespace App\Entities;


class UserHealth extends Entity {
    private AgeRange $ageRange;
    private Insurer $insurer;
    private FamilyRelation $relation;
    private HealthInsurance $healthInsurance;

    /**
     * Get the value of healthInsurance
     */ 
    public function getHealthInsurance()
    {
        return $this->healthInsurance;
    }

    /**
     * Set the value of healthInsurance
     *
     * @return  self
     */ 
    public function setHealthInsurance($healthInsurance)
    {
        $this->healthInsurance = $healthInsurance;
        return $this;
    }

    /**
     * Get the value of relation
     */ 
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * Set the value of relation
     *
     * @return  self
     */ 
    public function setRelation($relation)
    {
        $this->relation = $relation;
        return $this;
    }

    /**
     * Get the value of insurer
     */ 
    public function getInsurer()
    {
        return $this->insurer;
    }

    /**
     * Set the value of insurer
     *
     * @return  self
     */ 
    public function setInsurer($insurer)
    {
        $this->insurer = $insurer;
        return $this;
    }

    /**
     * Get the value of ageRange
     */ 
    public function getAgeRange()
    {
        return $this->ageRange;
    }

    /**
     * Set the value of ageRange
     *
     * @return  self
     */ 
    public function setAgeRange($ageRange)
    {
        $this->ageRange = $ageRange;
        return $this;
    }
}
<?php
namespace App\Entities;

class HealthInsurance extends Entity {
    private int $personCount;
    private string $description;
    private string $name;
    private string $discountCode;
    private int $patientGetPercantage;
    private int $chronicTime;
    private int $pregnancyTime;
    private int $type; // is it for single or for family
    private int $stars = 1; // 1 to 5
    private Insurance $insurance;

    /**
     * Get the value of stars
     */ 
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * Set the value of stars
     *
     * @return  self
     */ 
    public function setStars($stars)
    {
        $this->stars = $stars;
        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the value of pregnancyTime
     */ 
    public function getPregnancyTime()
    {
        return $this->pregnancyTime;
    }

    /**
     * Set the value of pregnancyTime
     *
     * @return  self
     */ 
    public function setPregnancyTime($pregnancyTime)
    {
        $this->pregnancyTime = $pregnancyTime;
        return $this;
    }

    /**
     * Get the value of chronicTime
     */ 
    public function getChronicTime()
    {
        return $this->chronicTime;
    }

    /**
     * Set the value of chronicTime
     *
     * @return  self
     */ 
    public function setChronicTime($chronicTime)
    {
        $this->chronicTime = $chronicTime;
        return $this;
    }

    /**
     * Get the value of patientGetPercantage
     */ 
    public function getPatientGetPercantage()
    {
        return $this->patientGetPercantage;
    }

    /**
     * Set the value of patientGetPercantage
     *
     * @return  self
     */ 
    public function setPatientGetPercantage($patientGetPercantage)
    {
        $this->patientGetPercantage = $patientGetPercantage;
        return $this;
    }

    /**
     * Get the value of discountCode
     */ 
    public function getDiscountCode()
    {
        return $this->discountCode;
    }

    /**
     * Set the value of discountCode
     *
     * @return  self
     */ 
    public function setDiscountCode($discountCode)
    {
        $this->discountCode = $discountCode;
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

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the value of personCount
     */ 
    public function getPersonCount()
    {
        return $this->personCount;
    }

    /**
     * Set the value of personCount
     *
     * @return  self
     */ 
    public function setPersonCount($personCount)
    {
        $this->personCount = $personCount;
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

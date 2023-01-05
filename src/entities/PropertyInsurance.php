<?php
namespace App\Entities;

class PropertyInsurance extends Insurance {
    private int $isComplex;
    private int $state;
    private int $unit;
    private BuildType $buildType;
    private int $area;
    private int $discountCode;
    private int $householdPrice; //thing price
    private BuildAge $buildAge;
    private City $city;
    private CostEachMeter $cost;
    private int $propertyId; // property insurance table id

    /**
     * Get the value of cost
     */ 
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set the value of cost
     *
     * @return  self
     */ 
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get the value of buildAge
     */ 
    public function getBuildAge()
    {
        return $this->buildAge;
    }

    /**
     * Set the value of buildAge
     *
     * @return  self
     */ 
    public function setBuildAge($buildAge)
    {
        $this->buildAge = $buildAge;
        return $this;
    }

    /**
     * Get the value of householdPrice
     */ 
    public function getHouseholdPrice()
    {
        return $this->householdPrice;
    }

    /**
     * Set the value of householdPrice
     *
     * @return  self
     */ 
    public function setHouseholdPrice($householdPrice)
    {
        $this->householdPrice = $householdPrice;
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
     * Get the value of area
     */ 
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set the value of area
     *
     * @return  self
     */ 
    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }

    /**
     * Get the value of buildType
     */ 
    public function getBuildType()
    {
        return $this->buildType;
    }

    /**
     * Set the value of buildType
     *
     * @return  self
     */ 
    public function setBuildType($buildType)
    {
        $this->buildType = $buildType;
        return $this;
    }

    /**
     * Get the value of unit
     */ 
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set the value of unit
     *
     * @return  self
     */ 
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get the value of isComplex
     */ 
    public function getIsComplex()
    {
        return $this->isComplex;
    }

    /**
     * Set the value of isComplex
     *
     * @return  self
     */ 
    public function setIsComplex($isComplex)
    {
        $this->isComplex = $isComplex;
        return $this;
    }
}
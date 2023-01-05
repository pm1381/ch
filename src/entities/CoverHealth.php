<?php
namespace App\Entities;


class UserHealth extends Entity {
    private int $maxPay;
    private Cover $cover;
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
     * Get the value of cover
     */ 
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set the value of cover
     *
     * @return  self
     */ 
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get the value of maxPay
     */ 
    public function getMaxPay()
    {
        return $this->maxPay;
    }

    /**
     * Set the value of maxPay
     *
     * @return  self
     */ 
    public function setMaxPay($maxPay)
    {
        $this->maxPay = $maxPay;

        return $this;
    }
}

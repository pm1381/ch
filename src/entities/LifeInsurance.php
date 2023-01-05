<?php
namespace App\Entities;

use App\Classes\Date;
use App\Entities\Payment;

class LifeInsurance extends Insurance {
    private Payment $payment;
    private string $minimumMonthlyPay;
    private int $increasePercent;
    private int $duration;
    private Date $minimumAge;
    private int $increaseFund;
    private int $medicalCost;
    private int $redemption;
    private int $deathFund;
    private int $lifeId;

    
    /**
     * Get the value of lifeId
     */ 
    public function getLifeId()
    {
        return $this->lifeId;
    }

    /**
     * Set the value of lifeId
     *
     * @return  self
     */ 
    public function setLifeId($lifeId)
    {
        $this->lifeId = $lifeId;
        return $this;
    }

    /**
     * Get the value of deathFund
     */ 
    public function getDeathFund()
    {
        return $this->deathFund;
    }

    /**
     * Set the value of deathFund
     *
     * @return  self
     */ 
    public function setDeathFund($deathFund)
    {
        $this->deathFund = $deathFund;
        return $this;
    }

    /**
     * Get the value of redemption
     */ 
    public function getRedemption()
    {
        return $this->redemption;
    }

    /**
     * Set the value of redemption
     *
     * @return  self
     */ 
    public function setRedemption($redemption)
    {
        $this->redemption = $redemption;
        return $this;
    }

    /**
     * Get the value of medicalCost
     */ 
    public function getMedicalCost()
    {
        return $this->medicalCost;
    }

    /**
     * Set the value of medicalCost
     *
     * @return  self
     */ 
    public function setMedicalCost($medicalCost)
    {
        $this->medicalCost = $medicalCost;
        return $this;
    }

    /**
     * Get the value of increaseFund
     */ 
    public function getIncreaseFund()
    {
        return $this->increaseFund;
    }

    /**
     * Set the value of increaseFund
     *
     * @return  self
     */ 
    public function setIncreaseFund($increaseFund)
    {
        $this->increaseFund = $increaseFund;
        return $this;
    }

    /**
     * Get the value of minimumAge
     */ 
    public function getMinimumAge()
    {
        return $this->minimumAge;
    }

    /**
     * Set the value of minimumAge
     *
     * @return  self
     */ 
    public function setMinimumAge($minimumAge)
    {
        $this->minimumAge = $minimumAge;
        return $this;
    }

    /**
     * Get the value of duration
     */ 
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @return  self
     */ 
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Get the value of increasePercent
     */ 
    public function getIncreasePercent()
    {
        return $this->increasePercent;
    }

    /**
     * Set the value of increasePercent
     *
     * @return  self
     */ 
    public function setIncreasePercent($increasePercent)
    {
        $this->increasePercent = $increasePercent;
        return $this;
    }

    /**
     * Get the value of minimumMonthlyPay
     */ 
    public function getMinimumMonthlyPay()
    {
        return $this->minimumMonthlyPay;
    }

    /**
     * Set the value of minimumMonthlyPay
     *
     * @return  self
     */ 
    public function setMinimumMonthlyPay($minimumMonthlyPay)
    {
        $this->minimumMonthlyPay = $minimumMonthlyPay;
        return $this;
    }

    /**
     * Get the value of payment
     */ 
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set the value of payment
     *
     * @return  self
     */ 
    public function setPayment($payment)
    {
        $this->payment = $payment;
        return $this;
    }
}
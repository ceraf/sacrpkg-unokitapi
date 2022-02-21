<?php

namespace sacrpkg\UnokitapiBundle\Entity;

use sacrpkg\UnokitapiBundle\Repository\UnokitRepository;

class Address implements UnokitEntityInterface
{
    private $country;
    private $state;
    private $county;
    private $city;

    public static function getUrlAddress(): string
    {
        return '/addresses/getone/';
    }
    
    public static function getRepository(): string
    {
        return UnokitRepository::class;
    }

    public function getCountry(): ?array
    {
        return $this->country;
    }    
    
    public function setCountry(?array $country): self
    {
        $this->country = $country;

        return $this;
    }     
    
    public function getState(): ?array
    {
        return $this->state;
    }    
    
    public function setState(?array $state): self
    {
        $this->state = $state;

        return $this;
    }    
    
    public function getCounty(): ?array
    {
        return $this->county;
    }    
    
    public function setCounty(?array $county): self
    {
        $this->county = $county;

        return $this;
    }  
    
    public function getCity(): ?array
    {
        return $this->city;
    }    
    
    public function setCity(?array $city): self
    {
        $this->city = $city;

        return $this;
    }
}

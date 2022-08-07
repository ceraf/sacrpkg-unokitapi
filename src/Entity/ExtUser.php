<?php

namespace sacrpkg\UnokitapiBundle\Entity;

use sacrpkg\UnokitapiBundle\Repository\ExtUserRepository;

class ExtUser implements UnokitEntityInterface
{
    private $id;
    private $email;
    private $status;
    private $full_name;
    private $location_id;
    private $rules;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    } 

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
    
    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }
    
    public function getLocationId(): ?string
    {
        return $this->location_id;
    }

    public function setLocationId(string $location_id): self
    {
        $this->location_id = $location_id;

        return $this;
    }

    public function getRules(): ?array
    {
        return $this->rules;
    }

    public function setRules(array $rules): self
    {
        $this->rules = $rules;

        return $this;
    }    
    
    public static function getUrlAddress(): string
    {
        return '/users/';
    }
    
    public static function getRepository(): string
    {
        return ExtUserRepository::class;
    }
}

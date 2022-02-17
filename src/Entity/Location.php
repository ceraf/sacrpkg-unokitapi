<?php

namespace sacrpkg\CrudBundle\Entity;

use sacrpkg\CrudBundle\Repository\UnokitRepository;

class Location implements UnokitEntityInterface
{
    private $id;
    private $location_type_id;
    private $uri;
    private $translations;
    private $parent_locations;
    
    public function getId(): ?int
    {
        return $this->id;
    }    
    
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }     

    public function getLocationTypeId(): ?string
    {
        return $this->location_type_id;
    }

    public function setLocationTypeId(string $location_type_id): self
    {
        $this->location_type_id = $location_type_id;

        return $this;
    }  

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }
    
    public function getTranslations(): ?array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): self
    {
        $this->translations = $translations;
        
        return $this;
    }

    public function getParentLocations(): ?array
    {
        return $this->parent_locations[0] ?? null;
    }

    public function setParentLocations(array $parent_locations): self
    {
        $this->parent_locations = $parent_locations;
        
        return $this;
    }

    public static function getUrlAddress(): string
    {
        return '/locations/';
    }
    
    public static function getRepository(): string
    {
        return UnokitRepository::class;
    }
}

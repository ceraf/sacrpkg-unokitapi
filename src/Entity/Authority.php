<?php

namespace sacrpkg\UnokitapiBundle\Entity;

use sacrpkg\UnokitapiBundle\Repository\UnokitRepository;

class Authority implements UnokitEntityInterface
{
    private $id;
    private $uri;
    private $translations;
    private $parent_authorities;
    
    public function getId(): ?int
    {
        return $this->id;
    }    
    
    public function setId(int $id): self
    {
        $this->id = $id;

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

    public function getParentAuthorities(): ?array
    {
        return $this->parent_authorities[0] ?? null;
    }

    public function setParentAuthorities(array $parent_authorities): self
    {
        $this->parent_authorities = $parent_authorities;
        
        return $this;
    }

    public static function getUrlAddress(): string
    {
        return '/business/authorities/';
    }
    
    public static function getRepository(): string
    {
        return UnokitRepository::class;
    }
}

<?php

namespace sacrpkg\CrudBundle\Entity;

use sacrpkg\CrudBundle\Repository\UnokitRepository;

class Currency implements UnokitEntityInterface
{
    private $id;
    private $uri;
    private $translations;
    
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

    public static function getUrlAddress(): string
    {
        return '/common/currencies/';
    }
    
    public static function getRepository(): string
    {
        return UnokitRepository::class;
    }
}

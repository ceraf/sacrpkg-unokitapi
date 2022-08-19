<?php

namespace sacrpkg\UnokitapiBundle\Entity;

use sacrpkg\UnokitapiBundle\Repository\UnokitRepository;

class Project implements UnokitEntityInterface
{
    private $id;
   // private $name;
    private $uri;
    private $type;
    private $status;
    private $translations;
    
    public function getId(): ?int
    {
        return $this->id;
    }
/*
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
*/
    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

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
    
    public function getType(): ?array
    {
        return $this->type;
    }

    public function setType(array $type): self
    {
        $this->type = $type;

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
        return '/common/projects/';
    }
    
    public static function getRepository(): string
    {
        return UnokitRepository::class;
    }
}

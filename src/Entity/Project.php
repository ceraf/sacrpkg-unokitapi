<?php

namespace sacrpkg\CrudBundle\Entity;

use sacrpkg\CrudBundle\Repository\UnokitRepository;

class Project implements UnokitEntityInterface
{
    private $id;
    private $name;
    private $uri;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
    
    public static function getUrlAddress(): string
    {
        return '/projects/';
    }
    
    public static function getRepository(): string
    {
        return UnokitRepository::class;
    }
}

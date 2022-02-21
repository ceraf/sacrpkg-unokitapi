<?php

namespace sacrpkg\UnokitapiBundle\Entity;

use sacrpkg\UnokitapiBundle\Repository\KBRepository;

class DataSupportValue implements KBEntityInterface
{
    private $id;
    private $uri;
    private $status;
    private $translations;
    private $supporting_field_id;
    
    public function getId(): ?int
    {
        return $this->id;
    }    
    
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }     
    
    public function getSupportingFieldId(): ?int
    {
        return $this->supporting_field_id;
    }    
    
    public function setSupportingFieldId(int $supporting_field_id): self
    {
        $this->supporting_field_id = $supporting_field_id;

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
    
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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
        return '/projects/data/supporting_field_values';
    }
    
    public static function getRepository(): string
    {
        return KBRepository::class;
    }
}

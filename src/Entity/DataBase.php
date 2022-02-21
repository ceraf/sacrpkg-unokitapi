<?php

namespace sacrpkg\UnokitapiBundle\Entity;

use sacrpkg\UnokitapiBundle\Repository\KBRepository;

class DataBase implements KBEntityInterface
{
    private $id;
    private $uri;
    private $status;
    private $kb_database_article_category_id;
    private $kb_api_article_category_id;
    private $translations;
    private $projects;
    
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
    
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }      
    
    public function getKbDatabaseArticleCategoryId(): ?int
    {
        return $this->kb_database_article_category_id;
    }

    public function setKbDatabaseArticleCategoryId(?int $kb_database_article_category_id): self
    {
        $this->kb_database_article_category_id = $kb_database_article_category_id;

        return $this;
    }

    public function getKbApiArticleCategoryId(): ?int
    {
        return $this->kb_api_article_category_id;
    }

    public function setKbApiArticleCategoryId(?int $kb_api_article_category_id): self
    {
        $this->kb_api_article_category_id = $kb_api_article_category_id;

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
    
    public function getProjects(): ?array
    {
        return $this->projects;
    }

    public function setProjects(array $projects): self
    {
        $this->projects = $projects;

        return $this;
    }
    
    public static function getUrlAddress(): string
    {
        return '/projects/data/bases';
    }
    
    public static function getRepository(): string
    {
        return KBRepository::class;
    }
}

<?php

namespace sacrpkg\UnokitapiBundle\Entity;

use sacrpkg\UnokitapiBundle\Repository\KBRepository;

class DataTable implements KBEntityInterface
{
    private $id;
    private $uri;
    private $status;
    private $kb_database_article_id;
    private $template_settings;
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
    
    public function getKBDatabaseArticleId(): ?int
    {
        return $this->kb_database_article_id;
    }

    public function setKBDatabaseArticleId(?int $kb_database_article_id): self
    {
        $this->kb_database_article_id = $kb_database_article_id;

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
    
    public function getTemplateSettings(): ?array
    {
        return $this->template_settings;
    }

    public function setTemplateSettings(array $template_settings): self
    {
        $this->template_settings = $template_settings;

        return $this;
    }    
    
    public static function getUrlAddress(): string
    {
        return '/projects/data/tables';
    }
    
    public static function getRepository(): string
    {
        return KBRepository::class;
    }
}

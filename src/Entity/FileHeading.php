<?php

declare(strict_types=1);

namespace App\DataImport\Entity;

use sacrpkg\UnokitapiBundle\Entity\UnokitEntityInterface;
use sacrpkg\UnokitapiBundle\Repository\UnokitRepository;

class FileHeading implements UnokitEntityInterface
{
    private $id;
    private $uri;
    private $translations;
    private $parent_file_headings;

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

    public function getParentFileHeading(): ?array
    {
        return $this->parent_file_headings[0] ?? null;
    }

    public function setParentFileHeading(array $parent_file_headings): self
    {
        $this->parent_file_headings = $parent_file_headings;

        return $this;
    }

    public static function getUrlAddress(): string
    {
        return '/miscellaneous/files/headings/';
    }

    public static function getRepository(): string
    {
        return UnokitRepository::class;
    }
}

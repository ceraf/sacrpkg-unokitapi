<?php

declare(strict_types=1);

namespace App\DataImport\Entity;

use sacrpkg\UnokitapiBundle\Entity\UnokitEntityInterface;
use sacrpkg\UnokitapiBundle\Repository\UnokitRepository;

class LocationType implements UnokitEntityInterface
{
    private int $id;
    private string $uri;
    /**
     * @var array<int, mixed>
     */
    private array $translations;

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
        return '/locations/types/';
    }

    public static function getRepository(): string
    {
        return UnokitRepository::class;
    }
}

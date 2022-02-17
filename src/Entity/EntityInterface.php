<?php

namespace sacrpkg\CrudBundle\Entity;

interface EntityInterface
{
    public static function getRepository(): string;
}

<?php

namespace sacrpkg\UnokitapiBundle\Entity;

interface KBEntityInterface extends EntityInterface
{
    public static function getUrlAddress(): string;
}

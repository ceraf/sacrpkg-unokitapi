<?php

namespace sacrpkg\UnokitapiBundle\Entity;

interface UnokitEntityInterface extends EntityInterface
{
    public static function getUrlAddress(): string;
}

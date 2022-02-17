<?php

namespace sacrpkg\CrudBundle\Entity;

interface UnokitEntityInterface extends EntityInterface
{
    public static function getUrlAddress(): string;
}

<?php

namespace sacrpkg\UnokitapiBundle;

use sacrpkg\UnokitapiBundle\Repository\RepositoryInterface;

interface DataImportInterface
{
    public function getRepository($classname): RepositoryInterface;
}

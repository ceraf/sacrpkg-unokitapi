<?php

namespace App\Model\DataImport;

use App\Model\DataImport\Repository\RepositoryInterface;

interface DataImportInterface
{
    public function getRepository($classname): RepositoryInterface;
}

<?php

namespace App\Model\DataImport;

use App\Model\DataImport\Repository\RepositoryInterface;

class DataImport implements DataImportInterface
{
    public function getRepository($entityname): RepositoryInterface
    {
        $repositoryclass = $entityname::getRepository();
        return new $repositoryclass($entityname);
    }
    
    public function flush($entity)
    {
        $repository = $this->getRepository(get_class($entity));
        $res = $repository->getDataMapper()->save($entity);
    }
}

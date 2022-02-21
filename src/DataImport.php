<?php

namespace sacrpkg\UnokitapiBundle;

use sacrpkg\UnokitapiBundle\Repository\RepositoryInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class DataImport implements DataImportInterface
{
    private $repositories;
    
    public function __construct(ContainerBagInterface $params)
    {
        $this->params = $params;
    }
    
    public function getRepository($entityname): RepositoryInterface
    {
        $repositoryclass = $entityname::getRepository();
        if (!($this->repositories[$entityname] ?? null)) {
            $this->repositories[$entityname] = new $repositoryclass($entityname, $this->params);
        }

        return $this->repositories[$entityname];
    }
    
    public function flush($entity)
    {
        $repository = $this->getRepository(get_class($entity));
        $res = $repository->getDataMapper()->save($entity);
    }
}

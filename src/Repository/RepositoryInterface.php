<?php

namespace sacrpkg\UnokitapiBundle\Repository;

use sacrpkg\UnokitapiBundle\DataMapper\MapperInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

interface RepositoryInterface
{
    public function find(int $id);
    
    public function findBy(array $where = [], array $sort = [], $limit = 0, $offset = 0): ?array;
    
    public function findOneBy(array $where);
    
    public function getEntityClass(): string;
    
    public function getDataMapper(): MapperInterface;
}

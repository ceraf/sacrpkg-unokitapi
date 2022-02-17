<?php

namespace sacrpkg\CrudBundle\Repository;

use sacrpkg\CrudBundle\DataMapper\MapperInterface;

interface RepositoryInterface
{
    public function __construct($entityname);
    
    public function find(int $id);
    
    public function findBy(array $where = [], array $sort = [], $limit = 0, $offset = 0): ?array;
    
    public function findOneBy(array $where);
    
    public function getEntityClass(): string;
    
    public function getDataMapper(): MapperInterface;
}

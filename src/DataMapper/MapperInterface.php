<?php

namespace sacrpkg\CrudBundle\DataMapper;

use sacrpkg\CrudBundle\Repository\RepositoryInterface;

interface MapperInterface
{
    public function __construct(StorageAdapterInterface $adapter, RepositoryInterface $repository);
    
    public function findById(int $id);
    
    public function findBy($where = [], $orderby = [], $limit = 0, $offset = 0);
}

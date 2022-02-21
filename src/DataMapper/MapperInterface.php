<?php

namespace sacrpkg\UnokitapiBundle\DataMapper;

use sacrpkg\UnokitapiBundle\Repository\RepositoryInterface;

interface MapperInterface
{
    public function __construct(StorageAdapterInterface $adapter, RepositoryInterface $repository);
    
    public function findById(int $id);
    
    public function findBy($where = [], $orderby = [], $limit = 0, $offset = 0);
    
    public function getList($where = [], $orderby = [], $limit = 0, $offset = 0, $cache);
}

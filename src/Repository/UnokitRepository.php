<?php

namespace sacrpkg\CrudBundle\Repository;

use sacrpkg\CrudBundle\DataMapper\UnokitMapper;
use sacrpkg\CrudBundle\DataMapper\UnokitStorage;
use sacrpkg\CrudBundle\DataMapper\MapperInterface;

class UnokitRepository implements RepositoryInterface
{
    protected $entityname;
    protected $datamapper;
    
    public function __construct($entityname)
    {
        $this->entityname = $entityname;
        $this->datamapper = new UnokitMapper(new UnokitStorage($entityname::getUrlAddress()), $this);
    }
    
    public function find(int $id)
    {
        $res = null;
        $res = $this->datamapper->findById($id);
        return $res;
    }
    
    public function getList(array $where = [], array $sort = [], $limit = 0, $offset = 0): ?array
    {
        $res = null;
        $res = $this->datamapper->getList($where, $sort, $limit, $offset);
        return $res;
    }    
    
    public function findBy(array $where = [], array $sort = [], $limit = 0, $offset = 0): ?array
    {
        $res = null;
        $res = $this->datamapper->findBy($where, $sort, $limit, $offset);
        return $res;
    }
    
    public function findOneBy(array $where)
    {
        $res = $this->findBy($where);
        
        return $res[0] ?? null;
    }
    
    public function getEntityClass(): string
    {
        return $this->entityname;
    }
    
    public function getDataMapper(): MapperInterface
    {
        return $this->datamapper;
    }
}

<?php

namespace sacrpkg\CrudBundle\DataMapper;

use sacrpkg\CrudBundle\Repository\RepositoryInterface;

class UnokitMapper implements MapperInterface
{
    private $adapter;
    private $repository;
    
    public function __construct(StorageAdapterInterface $adapter, RepositoryInterface $repository)
    {
        $this->adapter = $adapter;
        $this->repository = $repository;
    }
    
    public function findById(int $id)
    {
        $data = $this->adapter->findById($id);
        $res = null;
        if ($data) {
            $entityclass = $this->repository->getEntityClass();
            $entity = new $entityclass();
            foreach ($data as $key => $value) {
                $method = 'set' . str_replace('_', '', ucwords($key, '_'));
                if (is_callable([$entity, $method])) {
                    $entity->$method($value);
                }
            }
            $res = $entity;
        }
        
        return $res;
    }
    
    public function getList($where = [], $orderby = [], $limit = 0, $offset = 0)
    {
        $data = $this->adapter->findBy($where, $orderby, $limit);
        $res = null;
        if ($data) {
            $res = $data;
        }
        
        return $res;
    }    
    
    public function findBy($where = [], $orderby = [], $limit = 0, $offset = 0)
    {
        $data = $this->adapter->findBy($where, $orderby, $limit);
        $res = null;
        if ($data) {
            $entityclass = $this->repository->getEntityClass();
            foreach ($data as $item) {
                $entity = new $entityclass();
                foreach ($item as $key => $value) {
                    $method = 'set' . str_replace('_', '', ucwords($key, '_'));
                    if (is_callable([$entity, $method])) {
                        $entity->$method($value);
                    }
                }
                $res[] = $entity;
            }
        }
        
        return $res;
    }
}

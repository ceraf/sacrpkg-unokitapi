<?php

namespace sacrpkg\UnokitapiBundle\DataMapper;

use sacrpkg\UnokitapiBundle\Repository\RepositoryInterface;

class UnokitMapper implements MapperInterface
{
    private $adapter;
    private $repository;
    private $cache_list = [];
    private $objects = [];
    
    public function __construct(StorageAdapterInterface $adapter, RepositoryInterface $repository)
    {
        $this->adapter = $adapter;
        $this->repository = $repository;
    }
    
    public function findById(int $id)
    {
        $cache_key = $this->repository->getEntityClass().'_'.$id;
        if ($this->objects[$id] ?? null) {
            return $this->objects[$id];
        }
        
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
            $this->objects[$id] = $res;
        }

        return $res;
    }
    
    public function getList($where = [], $orderby = [], $limit = 0, $offset = 0, $cache = true)
    {
        $hash = md5(serialize($where).serialize($orderby).serialize($limit).serialize($offset));
        $cache_key = $this->repository->getEntityClass().'_'.$hash;
        
        if ($cache && ($this->cache_list[$cache_key] ?? null)) {
            return $this->cache_list[$cache_key];
        }

        if (0 === $offset) {
            $data = $this->adapter->findBy($where, $orderby, $limit);
        } else {
            $data = $this->adapter->findBy($where, $orderby, $limit, $offset);
        }

        $res = null;
        if ($data) {
            $res = $data;
        }
        
        if ($cache) {
            $this->cache_list[$cache_key] = $res;
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

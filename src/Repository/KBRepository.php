<?php

namespace sacrpkg\UnokitapiBundle\Repository;

use sacrpkg\UnokitapiBundle\DataMapper\KBMapper;
use sacrpkg\UnokitapiBundle\DataMapper\KBStorage;
use sacrpkg\UnokitapiBundle\DataMapper\MapperInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class KBRepository implements RepositoryInterface
{
    protected $entityname;
    protected $datamapper;
    protected $params;
    
    public function __construct($entityname, ContainerBagInterface $params)
    {
        $this->entityname = $entityname;
        $this->params = $params;
        
        $api_path = ($this->params->get('unokit_api'))['kb']['url'];
        $this->datamapper = new KBMapper(new KBStorage($api_path.$entityname::getUrlAddress()), $this);
    }
    
    public function find(int $id)
    {
        $res = null;
        $res = $this->datamapper->findById($id);
        return $res;
    }
    
    public function getList(array $where = [], array $sort = [], $limit = 0, $offset = 0, $cache = true): ?array
    { 
        $res = null;
        $res = $this->datamapper->getList($where, $sort, $limit, $offset, $cache);
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

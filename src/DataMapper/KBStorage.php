<?php

namespace sacrpkg\UnokitapiBundle\DataMapper;

use sacrpkg\UnokitapiBundle\Api;

class KBStorage implements StorageAdapterInterface
{
    private $api;
    private $address;
    
    public function __construct($address)
    {
        $this->api = new Api();
        $this->address = $address;
    }
    
    protected function prepareParams($where): array
    {
        $res = [];
        
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                if (is_bool($value))
                    $value = ($value) ? 'true' : 'false';
                elseif (is_array($value))
                    $value = implode(',', $value);
                $res[] = $key.'='.$value;
            }
        }
        
        return $res;
    }

    public function findById(int $id)
    {
        $procset = [
            'type' => 'list'
        ];     
        
        $this->api->setMethod(Api::METHOD_GET)
            ->setUrl($this->address.'?id='.$id)
            ->setParams([])
            ->process($procset); 
            
        $data = $this->api->getResult();
            
        return (count($data)) ? $data[0] : null;
    }

    public function findBy($where = [], $orderby = [], $limit = 0, $offset = 0)
    {
        $params = $this->prepareParams($where);
        //if ($this->tracking->getStartedAt())
        //    $params[] = 'date[type=publication]:from='.$this->tracking->getStartedAtSearch();
        
        $procset = [
            'type' => 'list',
            'limit' => $limit
        ];     
        
        if (!empty($orderby)) {
            $procset['sort'] = (array_keys($orderby))[0];
            $procset['sorttype'] = (array_values($orderby))[0];
            if (!empty($where))
                $procset['where'] = $where;
        }

        $this->api->setMethod(Api::METHOD_GET)
            ->setUrl($this->address)
            ->setParams($params)
            ->process($procset); 
            
        $data = $this->api->getResult();
            
        return (count($data)) ? $data : null;
    }
}

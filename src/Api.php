<?php

namespace sacrpkg\UnokitapiBundle;

class Api
{
    const NUM_RES_LIST = 450;
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PATCH = 'PATCH';
    
    private $url;
    private $params;
    private $method = 'GET';
    private $result;
    private $code;
    private $header;
    private $response;
    
    public function getResponse()
    {
        return $this->response;
    }
    
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;        
    }
    
    public function setHeader($header): self
    {
        $this->header = $header;
        return $this;      
    }
    
    public function setUrl($url): self
    {
        $this->url = $url;
        return $this;
    }
    
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }
    
    public function process($params = null): self
    {
        $method = strtolower($this->method);
        return $this->$method($params);
    }
    
    public function getResult()
    {
        return $this->result;
    }
    
    public function getHttpCode(): int
    {
        return $this->code;
    }
    
    public function isError(): bool
    {
        return !in_array($this->code, [200,201,202]);
    }
    
    private function patch($params): self
    {
        $data = ['data' => $this->params];
        $res = $this->sendPathRequest($this->url, json_encode($data), $this->header);
        $this->code = $res['code'];
        $this->result = $res['response'];
        
        return $this;
    }
    
    private function post($params): self
    {
        $data = ['data' => $this->params];
        $res = $this->sendPostRequest($this->url, json_encode($data), $this->header);
        $this->code = $res['code'];
        $this->result = $res['response'];

        return $this;
    }
    
    private function get($params): self
    {
        $method = 'get'.ucfirst($params['type'] ?? 'one');
        return $this->$method($params);
    }
    
    private function getOne($params): self
    {
        $res = [];

        $pagedata = $this->sendGetRequest($this->url, $this->header);
        $code = $pagedata['code'];
        if (in_array($code, [200,201,202])) {
            $content = json_decode($pagedata['response'], true);
            if (count($content['data'] ?? [])) {
                $res = $content['data']; 
            }
        }
        
        $this->code = $code;
        $this->result = $res;
        
        return $this;
    }
    
    private function getList($params): self
    {
        $limit = $params['limit'] ?? 0;
        $countitens = ($limit) ? $limit : self::NUM_RES_LIST;

      //  $this->params = ['locations_country_id=41'];
        $this->params[] = 'count='.$countitens;
      //  $this->params[] = 'q=events';
        $page = ($params['offset'] ?? 0) ? ((int)($params['offset']/$limit) + 1): 1;
        $res = [];
        $num = 0;
        do {
            $pageres = [];
            $url = $this->url.'?'.implode('&', $this->params).'&page='.$page;

            if ($params['sort'] ?? null) {
                $sortparam = $params['sort'];
                if ($params['sorttype'] ?? null) {
                    if (strtolower($params['sorttype']) == "asc")
                        $sortparam = '+'.$sortparam;
                    elseif (strtolower($params['sorttype']) == "desc")
                        $sortparam = '-'.$sortparam;
                }
                $url .= '&sort='. $sortparam;
            }
            $pagedata = $this->sendGetRequest($url, $this->header);

            $code = $pagedata['code'];
            if (in_array($code, [200,201,202])) {
                $content = json_decode($pagedata['response'], true);

                $this->response = $content;
                if (count($content['data'] ?? [])) {
                    $pageres = $content['data'];
                    if ($limit && (($num + count($pageres)) > $limit)) {
                        $pageres = array_slice($pageres, 0, $limit - $num);
                    }
                    $res = array_merge($res, $pageres);
                    $num += count($pageres);
                }
            }
            $page++;
        } while ((count($pageres) == self::NUM_RES_LIST) && (($limit == 0) || ($num <= $limit)));
        
        $this->code = $code;
        $this->result = $res;
        
        return $this;
    }
    
	public function sendDelRequest($url)
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
	//	curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch,CURLOPT_TIMEOUT, 20);
	//	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_NOBODY, false);
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close ($ch);
		return ['code' => $httpCode, 'response' => $response, 'info' => $info, 
		    'type' => 'DELETE', 'url' => $url];
	}	
	
	public function sendPathRequest($url, $data, $header = null)
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);     
		curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
		curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch,CURLOPT_TIMEOUT, 20);
        $headerdata = array('Content-Type: application/json');
        if ($header)
             $headerdata = array_merge($headerdata, $header);    
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headerdata);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_NOBODY, false);
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close ($ch);
		return ['code' => $httpCode, 'response' => $response, 'info' => $info, 
		    'type' => 'PATH', 'url' => $url];
	}
	
	public function sendPostRequest($url, $data, $header = null)
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
		curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 180);
		curl_setopt($ch,CURLOPT_TIMEOUT, 180);
        $headerdata = array('Content-Type: application/json');
        if ($header)
             $headerdata = array_merge($headerdata, $header);    
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headerdata);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_NOBODY, false);
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close ($ch);
		return ['code' => $httpCode, 'response' => $response, 'info' => $info, 
		    'type' => 'POST', 'url' => $url];
	}
	
	public function sendGetRequest($url, $header = null)
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch,CURLOPT_TIMEOUT, 20);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if ($header)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_NOBODY, false);
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close ($ch);
		return ['code' => $httpCode, 'response' => $response, 'info' => $info, 
		    'type' => 'POST', 'url' => $url];
	}
}

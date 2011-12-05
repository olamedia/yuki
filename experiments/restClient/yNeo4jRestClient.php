<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * yNeo4jRestClient
 *
 * @package yuki
 * @subpackage restClient
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yNeo4jRestClient extends yRestClient{
    public function __construct(){
        parent::__construct();
        curl_setopt($this->_curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    }
    public function bind($url){
        parent::bind($url);
        $this->_curl = curl_init($url);
        curl_setopt($this->_curl, CURLOPT_HTTPPROXYTUNNEL, false);
        curl_setopt($this->_curl, CURLOPT_PROXY, false);
        curl_setopt($this->_curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($this->_curl, CURLOPT_PORT, 7474);
    }
    /**
     * Get root
     */
    public function getRoot(){
        $json = $this->getJson('');
        //return $json;
        if ($this->_code() == 200){
            return $json;
        }
        return false;
    }
    public function createNode(){
        $this->post('node');
        if ($this->_code() == 201){
            return $this->_location();
        }
        return false;
    }
    /**
     * Get node
     * 200: OK
     * 404: Node not found
     * @param integer $id
     * @return stdClass
     */
    public function getNode($id){
        return $this->getJson('node/'.$id);
    }
    public function setNodeProperties($nodeId, $properties){
        
    }
    public function getNodeProperties($nodeId){
        return $this->getJson('node/'.$nodeId.'/properties');
    }
    public function removeNodeProperties($id){
        // 204: OK, no content returned
        // 404: Node not found
        $this->delete('node/'.$id.'/properties');
        if ($this->_code() == 204){
            return true;
        }
        return false;
    }
    public function getRelations($nodeId, $dir = 'all', $types = false){
        if (is_array($types)){
            $types = implode('&', $types);
        }
        return $this->getJson('node/'.$nodeId.'/relationships/'.$dir.($types === false?'':'/'.$types));
    }
}


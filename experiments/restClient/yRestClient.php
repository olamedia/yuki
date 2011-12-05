<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * yRestClient
 *
 * @package yuki
 * @subpackage restClient
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yRestClient{
    //Accept:application/json
    protected $_url = null;
    protected $_curl = null;
    public function getCurl(){
        return $this->_curl;
    }
    public function dump(){
        var_dump(curl_getinfo($this->_curl));
    }
    public function __construct(){
        $this->_curl = curl_init();
    }
    public function __destruct(){
        curl_close($this->_curl);
    }
    public function bind($url){
        $this->_url = yUri::fromString(strval($url));
    }
    protected function _code(){
        return curl_getinfo($this->_curl, CURLINFO_HTTP_CODE);
    }
    protected function _location(){
        return curl_getinfo($this->_curl, CURLINFO_EFFECTIVE_URL);
    }
    public function post($rel, $data){
        $url = $this->_url->rel($rel);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    public function getJson($rel){
        if ($json = $this->get($rel)){
            return json_decode($json);
        }
        return false;
    }
    public function get($rel){
        $url = $this->_url->rel($rel);
        //echo strval($url);
        curl_setopt($this->_curl, CURLOPT_HTTPGET, true);
        curl_setopt($this->_curl, CURLOPT_URL, strval($url));
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
        //var_dump($this->_curl);
        $result = curl_exec($this->_curl);
        // var_dump($result);
        //var_dump(curl_errno($this->_curl));
        //var_dump(curl_error($this->_curl));
        return $result;
    }
    public function delete($rel){
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $url = $this->_url->rel($rel);
    }
}


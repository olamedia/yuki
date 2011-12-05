<?php

class yModel implements ArrayAccess{
    protected $_data = null;
    protected $_isSaved = false;
    public function isDraft(){
        return (!$this->_isSaved) || $this->_data->isChanged();
    }
    public function markDraft(){
        $this->_isSaved = false;
    }
    public function markSaved(){
        $this->_isSaved = true;
        $this->_data->markUnchanged();
    }
    public function __construct(){
        $this->_data = new yTrackingRegistry();
    }
    public function offsetExists($offset){
        return $this->_data->has($offset);
    }
    public function offsetGet($offset){
        return $this->_data->get($offset);
    }
    public function offsetSet($offset, $value){
        $this->_data->set($offset, $value);
    }
    public function offsetUnset($offset){
        $this->_data->remove($offset);
    }
    public function importData($data){
        $this->_data->load($data);
        return $this;
    }
    public function exportData(){
        return $this->_data->toArray();
    }
    public function save(){
        if (!$this->_data->isChanged()){
            return false;
        }
    }
    public function __get($name){
        $method = 'get'.ucfirst($name);
        if (method_exists($this, $method)){
            return call_user_func(array($this, $method));
        }
        return $this->_data->get($name, null);
    }
    public function __set($name, $value){
        $method = 'set'.ucfirst($name);
        if (method_exists($this, $method)){
            return call_user_func(array($this, $method), $value);
        }
        $this->_data->set($name, $value);
    }
}

/**
 * {
 *      '_id': '3243256df8278SA345',
 *      'title': 'dsfa dsjk'
 * }
 */
class post extends yModel{
    public function getId(){
        return $this->id;
    }
}

$yModelMapper
        ->selectStorage('local.mysql.storage')
        ->selectModel('post')
        ->register()
        ->setTable('posts_table')
        ->setProperties(array(
            'id'=>array()
        ));
$post = new post();
$post->id = 3;
$post->updatedAt = '20/09/2011'; // $post->setUpdatedAt('20/09/2011');
//
$post->save();
// post.scheme.php
return array(
    'id'=>array(
    )
);

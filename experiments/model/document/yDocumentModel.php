<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * yDocumentModel
 *
 * @package yuki
 * @subpackage model
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yDocumentModel{
    const
    primaryKey = 'primaryKey',
    documentId = 'documentId'
    ;
    protected $_properties = array(
        'id'=>array(
            'class'=>'stringProperty',
            'primaryKey'=>true, // CouchDB will force '_id' as field name
            'autoIncrement'=>false,
            'documentId'=>true,
            'field'=>'id'
        ),
        'title'=>array(
            'class'=>'stringProperty',
            'field'=>'title'
        ),
        'data'=>array(
            'class'=>'jsonProperty',
            'field'=>'data'
        )
    );
    public function getId(){
        
    }
    public static function get($id){
        
    }
    public function save(){
        if (!$this->isDraft()){
            return;
        }
        if ($this->isSaved()){
            $this->update();
        }else{
            $this->insert();
        }
    }
    public function insert(){
        $query = new yModelQuery();
        $query->setType('INSERT');
        $query->setDocumentId($this->getDocumentId());
        $query->setDataObject($this->getDataObject());
    }
    public function update(){
        
    }
}


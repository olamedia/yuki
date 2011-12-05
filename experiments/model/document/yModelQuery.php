<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * yModelQuery
 *
 * @package yuki
 * @subpackage model
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yModelQuery{
    const
    SELECT = 'SELECT',
    INSERT = 'INSERT',
    UPDATE = 'UPDATE',
    DELETE = 'DELETE'
    ;
    private $_type = 'SELECT';
    private $_model = null;
    public function setType($queryType){
        $this->_type = $queryType;
    }
    public function setModel($model){
        $this->_model = $model;
    }
    public function getDocumentId(){
        return $this->_model->getDocumentId();
    }
}


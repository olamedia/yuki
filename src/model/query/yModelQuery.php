<?php

/*
 * This file is part of the yuki package.
 * Copyright (c) 2011 olamedia <olamedia@gmail.com>
 *
 * This source code is release under the MIT License.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
    private $_selectedModels = array();
    private $_selected = array();
    private $_expressions = array();
    private $_from = 0;
    private $_limit = false;
    public function getSelected(){
        return $this->_selected;
    }
    public function getExpressions(){
        return $this->_expressions;
    }
    private function _select($arg, $include = false){
        if ($arg instanceof yModelExpression){
            $this->_expressions[] = $arg;
            $left = $arg->getLeft();
            if (is_object($left)){
                $this->_select($left, false);
            }
            $right = $arg->getRight();
            if (is_object($right)){
                $this->_select($right, false);
            }
        }elseif ($arg instanceof yModelCollection){
            $this->_selectedModels[$arg->getClass()] = true;
            if ($include){
                $this->_selected[] = $arg;
            }
        }elseif ($arg instanceof yModelField){
            $this->_selectedModels[$arg->getClass()] = true;
            if ($include){
                $this->_selected[] = $arg;
            }
        }elseif ($arg instanceof yModelFunction){
            if ($include){
                $this->_selected[] = $arg;
            }
            $arguments = $arg->getArguments();
            foreach ($arguments as $argument){
                if (is_object($argument)){
                    $this->_select($argument, false);
                }
            }
        }
    }
    public function select(){
        $args = func_get_args();
        foreach ($args as $arg){
            $this->_select($arg, true);
        }
        return $this;
    }
    public function where(){
        $args = func_get_args();
        foreach ($args as $arg){
            $this->_select($arg, false);
        }
        return $this;
    }
    public function __construct(){
        $args = func_get_args();
        foreach ($args as $arg){
            $this->_select($arg, false);
        }
        return $this;
    }
    public function asc($field){
        $this->where($field->asc());
    }
    public function desc($field){
        $this->where($field->desc());
    }
    public function limit(){
        $args = func_get_args();
        switch (func_num_args()){
            case 1:
                $this->_from = 0;
                $this->_limit = $args[0];
                break;
            case 2:
                $this->_from = $args[0];
                $this->_limit = $args[1];
                break;
        }
    }
}


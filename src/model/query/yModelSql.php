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
 * yModelSql
 *
 * @package yuki
 * @subpackage model
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yModelSql{
    /**
     * @var yModelQuery
     */
    private $_query = null;
    private static $_operators = array(
        'is'=>'=',
        'not'=>'<>',
        'gt'=>'>',
        'gte'=>'>=',
        'lt'=>'<',
        'lte'=>'<=',
    );
    public function __construct($query){
        $this->_query = $query;
    }
    private function _value($value){
        if ($value instanceof yModelField){
            return "`".$value->getPropertyName()."`";
        }else{
            return "'".strval($value)."'";
        }
    }
    private function _whereSql(){
        $expressions = $this->_query->getExpressions();
        $a = array();
        foreach ($expressions as $expression){
            if (array_key_exists($expression->getOperator(), self::$_operators)){
                $op = self::$_operators[$expression->getOperator()];
                $a[] = $this->_value($expression->getLeft()).' '.$op.' '.$this->_value($expression->getRight());
            }else{
                // unknown operator
            }
        }
        if (count($a)){
            return ' WHERE '.implode(' AND ', $a);
        }
        return '';
    }
    private function _whatSql(){
        return '*';
    }
    private function _fromSql(){
        return ' FROM `XXX`';
    }
    public function __toString(){
        return 'SELECT '.$this->_whatSql().$this->_fromSql().$this->_whereSql();
    }
}


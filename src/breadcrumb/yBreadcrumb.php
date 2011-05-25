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
 * yBreadcrumb - Represents a single Breadcrumb in a Breadcrumb trail.
 * Mixed with microdata and RDF
 * 
 * Note: This is an experimental format. 
 * Depending on feedback and on other available markup standards, 
 * it may be modified or replaced in the future.
 * 
 * @link http://www.google.com/support/webmasters/bin/answer.py?hlrm=ru&answer=185417
 * @link http://www.google.com/webmasters/tools/richsnippets
 * @link http://www.data-vocabulary.org/Breadcrumb/
 *
 * @package Expression package is undefined on line 12, column 15 in Templates/Scripting/PHPClass.php.
 * @subpackage 
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yBreadcrumb implements Countable{
    protected static $_delimiter = '›';
    protected $_url = '';
    protected $_title = '';
    /**
     * Child breadcrumb
     * @var yBreadcrumb 
     */
    protected $_child = null;
    public function getUrl(){
        return $this->_url;
    }
    public function setUrl($url){
        $this->_url = $url;
        return $this;
    }
    public function getTitle(){
        return $this->_title;
    }
    public function setTitle($title){
        $this->_title = $title;
        return $this;
    }
    public function __construct($url, $title){
        $this->_url = $url;
        $this->_title = $title;
    }
    public function append($child){
        $this->_child = $child;
    }
    public function prepend($parent){
        $parent->append($this);
    }
    public function getLinkHtml(){
        return '<a href="'.$this->_url.'" itemprop="url" rel="v:url">'.
                '<span itemprop="title" property="v:title">'.
                // do not encode existing html entities
                htmlspecialchars($this->_title, ENT_QUOTES, 'UTF-8', false).
                '</span>'.
                '</a>';
    }
    /**
     * <div itemprop="child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
     *      <a href="http://www.example.com/books/authors/stephenking" itemprop="url">
     *          <span itemprop="title">Stephen King</span>
     *      </a>
     * </div>
     * @return string 
     */
    public function getChildHtml(){
        $h = ' '.self::$_delimiter;
        $h .= ' <span rel="v:child">';
        $h .= '<span class="breadcrumb-child" itemprop="child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
        $h .= $this->getLinkHtml();
        if ($this->_child !== null){
            $h .= $this->_child->getChildHtml();
        }
        $h .= '</span>';
        $h .= '</span>';
        return $h;
    }
    public function __toString(){
        $h = '<div class="nav breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
        $h .= '<span typeof="v:Breadcrumb">';
        $h .= $this->getLinkHtml();
        if ($this->_child !== null){
            $h .= $this->_child->getChildHtml();
        }
        $h .= '</span>';
        $h .= '</div>';
        return $h;
    }
    public function count(){
        if ($this->_child === null){
            return 1;
        }
        return 1 + count($this->_child);
    }
    public function toArray(){
        $a = array();
        if ($this->_child !== null){
            $a = $this->_child->toArray();
        }
        array_unshift($a, $this);
        return $a;
    }
}

/**
 * Microdata-enabled
 * <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
 * <a href="http://www.example.com/books" itemprop="url">
 *   <span itemprop="title">Books</span>
 * </a> ›
 * <div itemprop="child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
 *   <a href="http://www.example.com/books/authors" itemprop="url">
 *     <span itemprop="title">Authors</span>
 *   </a> ›
 *   <div itemprop="child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
 *     <a href="http://www.example.com/books/authors/stephenking" itemprop="url">
 *       <span itemprop="title">Stephen King</span>
 *     </a>
 *   </div>
 * </div>
 * </div>
 * 
 * RDF-enabled
 * <div xmlns:v="http://rdf.data-vocabulary.org/#"> 
 * <span typeof="v:Breadcrumb">
 *   <a href="http://www.example.com/books" rel="v:url" property="v:title">
 *     Books
 *   </a> ›
 *   <span rel="v:child">
 *     <span typeof="v:Breadcrumb">
 *       <a href="http://www.example.com/books/authors" rel="v:url" property="v:title">
 *         Authors
 *       </a> ›
 *       <span rel="v:child">         
 *         <span typeof="v:Breadcrumb">
 *           <a href="http://www.example.com/books/authors/stephenking" rel="v:url" property="v:title">
 *             Stephen King
 *           </a> ›          
 *         </span>
 *       </span>
 *     </span>
 *   </span>
 * </span>
 * </div>
 */

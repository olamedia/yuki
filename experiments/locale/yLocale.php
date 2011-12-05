<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * yLocale
 *
 * @package Expression package is undefined on line 12, column 15 in Templates/Scripting/PHPClass.php.
 * @subpackage 
 * @version SVN: $Id$
 * @revision SVN: $Revision$
 * @date $Date$
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yLocale{
    protected static $_known = array(
        'en'=>'English',
        'en_GB'=>'English/United Kingdom',
        'en_US'=>'English/United States',
        'ru'=>'Russian',
        'ru_RU'=>'Russian/Russia',
        'ru_UA'=>'Russian/Ukraine',
        'uk'=>'Ukrainian',
        'uk_UA'=>'Ukrainian/Ukraine',
    );
    protected $_language = null;
    protected $_country = null;
    public function setLanguage($code){
        $this->_language = $code;
    }
    public function setCountry($code){
        $this->_country = $code;
    }
    public function __toString(){
        return ($this->_language === null?'en':strtolower($this->_language)).
                ($this->_country === null?'':'_'.strtoupper($this->_country));
    }
}


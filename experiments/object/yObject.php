<?php

/*
 * This file is part of the yuki package.
 * Copyright (c) 2011 olamedia <olamedia@gmail.com>
 *
 * Licensed under The MIT License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * yObject
 *
 * @package yuki
 * @subpackage object
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yObject{
    /**
     * Chainable constructor
     * @return self New instance
     */
    public static function create(){
        $class = get_called_class();
        return new $class;
    }
}


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
 * yController
 *
 * @package yuki
 * @subpackage controller
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yController{
    /**
     * Controller's URI
     * @var yUri
     */
    protected $_uri = null;
    /**
     * Gets URI, relative to controller
     * @param string $uri
     * @return yUri
     */
    public function rel($uri){
        return $this->_uri->rel($uri);
    }
    /**
     * Runs controller at given url
     * @param string $uri 
     */
    public function run($uri){
        if (is_string($uri)){
            $uri = yUri::fromString($uri);
        }
        $this->_uri = $uri;
    }
}


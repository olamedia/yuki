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
 * yDebugger
 *
 * @package yuki
 * @subpackage debug
 * @version SVN: $Id: yDebugger.php 126 2011-02-19 22:12:41Z olamedia@gmail.com $
 * @revision SVN: $Revision: 126 $
 * @date $Date: 2011-02-20 03:12:41 +0500 (Вс, 20 фев 2011) $
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yDebugger{
    /**
     * Gets unformatted lines of source code from file
     * @param string $filename File name
     * @param int $startLine Start line number, starts at 1
     * @param int $endLine End line number
     * @return string Source code lines
     */
    public static function getLinesSource($filename, $startLine, $endLine){
        if (!is_file($filename)){
            return false;
        }
        $source = '';
        $fp = fopen($filename, 'r');
        $currentLine = 1;
        while (($s = fgets($fp)) !== false){
            if ($currentLine >= $startLine){
                $source .= $s;
            }
            $currentLine++;
            if ($currentLine > $endLine){
                // reached last required line
                break;
            }
        }
        return $source;
    }
    /**
     * Gets unformatted line(s) of source code from file
     * @param string $filename File name
     * @param int $line Line number, starts at 1
     * @param int $padding Padding
     * @return string Source code line(s)
     */
    public static function getLineSource($filename, $line, $padding = 0){
        return self::getLinesSource($filename, $line - $padding, $line + $padding);
    }
    public static function getLineSourceHtml($filename, $line, $padding = 0){
        $shift = -$padding;
        $lines = explode("\n", self::getLineSource($filename, $line, $padding));
        foreach ($lines as &$s){
            $s = '<span class="line'.($shift == 0?' line_hightlight':'').'">'.
                    '<span class="num">'.($line + $shift).'</span> '.htmlspecialchars($s).'</span>';
            $shift++;
        }
        return '<pre><code>'.implode('', $lines).'</code></pre>';
    }
}


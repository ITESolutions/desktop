<?php

/**
 * ViewFactory Class for producing views or other output
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
 
namespace views;

defined ('_ITE') or die;

abstract class ViewFactory {
    /**
     * getView ($type = 'html')
     * @param string $type Case-insensitive type of view to fetch: Defaults to HTML if left blank
     * @return \Framework\Views\Xml|\Framework\Views\Html|\Framework\Views\Output|\Framework\Views\Json
     */
    
    public static function getView($type = 'html') {
        switch (strtoupper($type)) {
            case 'HTML':
                return new \views\html();
            case 'XML':
                return new \views\Xml();
            case 'JSON':
                return new \views\Json();
            default :
                return new \views\Output();
        }
    }
}

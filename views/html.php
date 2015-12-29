<?php

/**
 * ITE Framework View class for HTML output
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace views;

class html extends \abstracts\View {
    const SECTION_EXPRESSION = '<!--(.*?)-->';
    const MODIFIER_EXPRESSION = '/\[([^\]]*)\]/';
    const DEFAULT_TEMPLATE = 'default';
    const TEMPLATE_EXTENSION = '.html';
    
    private $_component, $_template, $_templateData = array();
    
    private $_replace = array(
            '{b}'       => '<strong>',
            '{/b}'      => '</strong>',
            '{i}'       => '<em>',
            '{/i}'      => '</em>',
            '{code}'    => '<p class="code">',
            '{/code}'    => '</p>'
        );

    /**
     * Construct
     */
    
    public function __construct() {
        $this->_initialize();
    }
    
    /**
     * 
     */

    private function _initialize() {
        $this->setTemplate(static::DEFAULT_TEMPLATE);      
    }
    
    /**
     * 
     */
    
    private function _loadTemplate() {
        ob_start();
        include $this->_template;
        $this->_output = ob_get_contents();
        ob_end_clean();
    }
    
    /**
     * Getter method for the view data that will be rendered into the template
     * @param type $name
     * @return type
     */
    
    public function get($name) {
        if (is_array($name)) {
            return array_intersect_key($this->_templateData, $name);
        }
        return $this->_templateData[$name];
    }
    
    /**
     * 
     * @param type $values
     */

    public function set($values) {
        if (is_array($values)) {
            foreach ($values as $key => $value) {
                $this->_templateData[$key] = $value;
            }
        }
    }
    
    /**
     * 
     * @param type $template
     */

    public function setTemplate($template) {
        //$this->_template = $this->_templateFolder() . $template . DS . 'template' . self::TEMPLATE_EXTENSION;
    }
    
    private function _setComponent() {
        $this->_component = __DIR__ . DS . Helpers\Router::ControllerName() . DS . Helpers\Router::Action() . '.php';
        
        $this->set(array(
            'component' => function() {
                if (file_exists ($this->_component)) {
                    ob_start();
                    include $this->_component;
                    $buffer = ob_get_flush();
                    ob_end_clean();
                    return $buffer;
                }
                return 'Component not found: ' . $this->_component;
            }
        ));
    }
    
    /**
     * Function render()
     * 
     */
    
    public function render() {
        $this->_loadTemplate();
        $this->_setComponent();
        foreach ($this->_templateData as $key => $value) {
            if (is_callable($value)) {
                $value = $value();
            }
            $this->_output = str_replace('<!--' . strtoupper($key) . '-->', $value, $this->_output);
        }
        $this->_replaceTemplateTags();
        parent::render();
    }
    
    /**
     * Function _replaceTemplateTags()
     * 
     */
    
    private function _replaceTemplateTags() {
        $this->_output = str_ireplace(array_keys($this->_replace), array_values($this->_replace), $this->_output);
    }
}

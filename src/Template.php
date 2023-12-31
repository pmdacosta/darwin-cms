<?php

class Template {
    private $layout;

    public function __construct($layout) {
        $this->layout = $layout;
    }

    public function view($template, $variables) {
        extract($variables);
        include VIEW_PATH . 'layout/'. $this->layout .'.html';
    }
}
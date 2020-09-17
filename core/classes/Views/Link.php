<?php

namespace Core\Views;

class Link extends \Core\View
{

    public function render($path = ROOT . '/core/templates/link.tpl.php')
    {
        return parent::render($path);
    }
}
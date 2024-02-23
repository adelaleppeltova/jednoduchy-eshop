<?php

class AdminController extends Controller
{
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Administrace',
            'key_words' => 'admin',
            'desc' => 'Administrace jednoduchého e-shopu.'
        );

        $this->view = 'admin/blank';
        if (count($parameters) > 1) {
            switch ($parameters[1]) {
                case 'categories':
                    $this->view = 'admin/categories';
                    break;
            }
        }
    }
}

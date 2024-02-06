<?php

class CategoryController extends Controller
{
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Kategorie',
            'key_words' => 'category',
            'desc' => 'Kategorie'
        );

        $this->view = 'category';
    }
}

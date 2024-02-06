<?php

class HomepageController extends Controller
{
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Domů',
            'key_words' => 'homepage',
            'desc' => 'Domovská stránka jednoduchého e-shopu.'
        );

        $this->view = 'homepage';
    }
}

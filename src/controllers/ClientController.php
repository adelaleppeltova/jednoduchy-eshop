<?php

class ClientController extends Controller
{
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Vaše údaje',
            'key_words' => 'client',
            'desc' => 'Vaše osobní údaje'
        );

        $this->view = 'client';
    }
}

<?php

class AccountController extends Controller
{
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Můj účet',
            'key_words' => 'account',
            'desc' => 'Vaše osobní údaje'
        );

        $this->view = 'client';
    }
}

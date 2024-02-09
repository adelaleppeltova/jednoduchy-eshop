<?php

class SignupController extends Controller
{
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Registrace',
            'key_words' => 'sign up',
            'desc' => 'Registrujte se.'
        );

        $this->view = 'signup';
    }
}

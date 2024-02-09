<?php

class SigninController extends Controller
{
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Přihlásit se',
            'key_words' => 'sign in',
            'desc' => 'Přihlaste se ke svému účtu.'
        );

        $this->view = 'signin';
    }
}

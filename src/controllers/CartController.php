<?php

class CartController extends Controller
{
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Košík',
            'key_words' => 'cart',
            'desc' => 'Váš košík'
        );

        $this->view = 'cart';
    }
}

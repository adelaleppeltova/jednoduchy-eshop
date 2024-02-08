<?php

class CheckoutController extends Controller
{
    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Checkout',
            'key_words' => 'checkout',
            'desc' => 'Checkout'
        );

        $this->view = 'checkout';
    }
}

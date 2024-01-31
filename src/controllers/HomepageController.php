<?php

class HomepageController extends Controller
{
    function process(array $parameters): void
    {
        $this->view = 'homepage';
    }
}

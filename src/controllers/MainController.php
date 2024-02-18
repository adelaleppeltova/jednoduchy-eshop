<?php

class MainController extends Controller
{
    function process(array $parameters): void
    {
        switch ($parameters[0]) {
            case "kosik":
                $this->header = array(
                    'title' => 'Košík',
                    'key_words' => 'cart',
                    'desc' => 'Košík'
                );

                $this->view = 'cart';
                break;

            case "kategorie":
                $this->header = array(
                    'title' => 'Kategorie',
                    'key_words' => 'category',
                    'desc' => 'Kategorie'
                );

                $this->view = 'category';

                break;






            default:
                $this->header = array(
                    'title' => 'Domů',
                    'key_words' => 'homepage',
                    'desc' => 'Domovská stránka jednoduchého e-shopu.'
                );

                $this->view = 'homepage';
                break;
        }
    }
}

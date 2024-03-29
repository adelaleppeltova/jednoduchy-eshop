<?php

class MainController extends Controller
{

    protected array $products;
    public function __construct(array $products)
    {
        $this->products = $products;
    }
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



            default:
                $this->header = array(
                    'title' => 'Domů',
                    'key_words' => 'homepage',
                    'desc' => 'Domovská stránka jednoduchého e-shopu.'
                );

                $this->view = 'homepage';
                break;
        }

        $this->data['products'] = $this->products;
    }
}

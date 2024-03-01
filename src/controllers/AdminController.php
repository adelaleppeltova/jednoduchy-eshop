<?php

class AdminController extends Controller
{

    protected array $categories;
    protected array $products;
    protected array $transports;


    public function __construct(array $categories, array $products, array $transports)
    {
        $this->categories = $categories;
        $this->products = $products;
        $this->transports = $transports;
    }



    function process(array $parameters): void
    {
        $this->header = array(
            'title' => 'Administrace',
            'key_words' => 'admin',
            'desc' => 'Administrace jednoduchého e-shopu.'
        );




        $this->view = 'admin/blank';
        if (count($parameters) > 1) {
            switch ($parameters[1]) {
                case 'categories':
                    $this->view = 'admin/categories';
                    break;

                case 'products':
                    $this->view = 'admin/products';
                    break;

                case 'transports':
                    $this->view = 'admin/transports';
                    break;
            }
        }


        $this->data['categories'] = $this->categories;
        $this->data['products'] = $this->products;
        $this->data['transports'] = $this->transports;


        $this->data['selectedCategory'] = CategoryManager::getCategory(1);
    }
}

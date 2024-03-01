<?php

class AdminController extends Controller
{

    protected array $categories;
    protected array $products;
    protected array $transports;
    protected array $payments;
    protected array $users;



    public function __construct(array $categories, array $products, array $transports, array $payments, array $users)
    {
        $this->categories = $categories;
        $this->products = $products;
        $this->transports = $transports;
        $this->payments = $payments;
        $this->users = $users;
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

                case 'payments':
                    $this->view = 'admin/payments';
                    break;
                case 'clients':
                    $this->view = 'admin/clients';
                    break;
            }
        }


        $this->data['categories'] = $this->categories;
        $this->data['products'] = $this->products;
        $this->data['transports'] = $this->transports;
        $this->data['payments'] = $this->payments;
        $this->data['users'] = $this->users;


        $this->data['selectedCategory'] = CategoryManager::getCategory(1);
    }
}

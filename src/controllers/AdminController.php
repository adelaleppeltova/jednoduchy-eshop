<?php

class AdminController extends Controller
{

    // protected array $categories;
    // protected array $products;
    // protected array $transports;
    // protected array $payments;
    // protected array $users;



    // public function __construct(array $categories, array $products, array $transports, array $payments, array $users)
    // {
    //     $this->categories = $categories;
    //     $this->products = $products;
    //     $this->transports = $transports;
    //     $this->payments = $payments;
    //     $this->users = $users;
    // }


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

                    if (count($parameters) > 2 && $parameters[2] == "edit") {
                        if ($_POST) {
                            try {
                                $keys = array('url', 'title', 'descript');
                                $category = array_intersect_key($_POST, array_flip($keys));
                                if (isset($_GET["id"])) {
                                    $id = $_GET["id"];
                                } else {
                                    $id = false;
                                }
                                CategoryManager::saveCategory($id, $category);
                                $this->addMessage('Údaje byly změněny.');
                                $this->redirect('admin/categories');
                            } catch (Throwable $exeption) {
                                $this->addMessage($exeption->getMessage());
                            }
                        }
                        if (isset($_GET["id"])) {
                            $this->data["category"] = CategoryManager::getCategory($_GET["id"]);
                            $this->view = "admin/editCategories";
                        } else {
                            $this->view = "admin/newCategory";
                        }
                    } else {
                        $this->view = 'admin/categories';
                        $this->data['categories'] = CategoryManager::getCategories();
                    }
                    break;

                case 'products':

                    $this->view = 'admin/products';
                    $this->data['products'] = ProductManager::getProducts();

                    break;

                case 'transports':
                    $this->view = 'admin/transports';
                    $this->data['transports'] = TransportManager::getTransports();

                    break;

                case 'payments':
                    $this->view = 'admin/payments';
                    $this->data['payments'] = PaymentManager::getPayments();

                    break;
                case 'clients':
                    $this->view = 'admin/clients';
                    $this->data['users'] = UserManager::getUsers();

                    break;
            }
        }


        $this->data['selectedCategory'] = CategoryManager::getCategory(1);
    }
}

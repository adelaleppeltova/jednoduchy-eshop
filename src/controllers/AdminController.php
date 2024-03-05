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
                    if (count($parameters) > 2) {
                        if ($parameters[2] == "edit") {
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
                        }
                        if ($parameters[2] == "delete") {
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];
                            } else {
                                $id = false;
                            }

                            CategoryManager::deleteCategories($id);
                            $this->addMessage('Položka byla smazána.');
                            $this->redirect('admin/categories');
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
                    if (count($parameters) > 2 && $parameters[2] == "edit") {
                        if ($_POST) {
                            try {
                                $keys = array('title', 'price', 'shortdesc', 'longdesc', 'image', 'categories_id');
                                $product = array_intersect_key($_POST, array_flip($keys));
                                if (isset($_GET["id"])) {
                                    $id = $_GET["id"];
                                } else {
                                    $id = false;
                                }
                                ProductManager::saveProduct($id, $product);
                                $this->addMessage('Údaje byly změněny.');
                                $this->redirect('admin/products');
                            } catch (Throwable $exeption) {
                                $this->addMessage($exeption->getMessage());
                            }
                        }

                        $this->data['categories'] = CategoryManager::getCategories();

                        if (isset($_GET["id"])) {
                            $this->data["product"] = ProductManager::getProduct($_GET["id"]);
                            $this->view = "admin/editProducts";
                        } else {
                            $this->view = "admin/newProducts";
                        }
                    } else {
                        $this->view = 'admin/products';
                        $this->data['products'] = ProductManager::getProducts();
                    }

                    break;

                case 'transports':

                    if (count($parameters) > 2 && $parameters[2] == "edit") {
                        if ($_POST) {
                            try {
                                $keys = array('title', 'price');
                                $transport = array_intersect_key($_POST, array_flip($keys));
                                if (isset($_GET["id"])) {
                                    $id = $_GET["id"];
                                } else {
                                    $id = false;
                                }
                                TransportManager::saveTransport($id, $transport);
                                $this->addMessage('Údaje byly změněny.');
                                $this->redirect('admin/transports');
                            } catch (Throwable $exeption) {
                                $this->addMessage($exeption->getMessage());
                            }
                        }
                        if (isset($_GET["id"])) {
                            $this->data["transport"] = TransportManager::getTransport($_GET["id"]);
                            $this->view = "admin/editTransports";
                        } else {
                            $this->view = "admin/newTransports";
                        }
                    } else {
                        $this->view = 'admin/transports';
                        $this->data['transports'] = TransportManager::getTransports();
                    }

                    break;

                case 'payments':
                    if (count($parameters) > 2 && $parameters[2] == "edit") {
                        if ($_POST) {
                            try {
                                $keys = array('title', 'price');
                                $payment = array_intersect_key($_POST, array_flip($keys));
                                if (isset($_GET["id"])) {
                                    $id = $_GET["id"];
                                } else {
                                    $id = false;
                                }
                                PaymentManager::savePayment($id, $payment);
                                $this->addMessage('Údaje byly změněny.');
                                $this->redirect('admin/payments');
                            } catch (Throwable $exeption) {
                                $this->addMessage($exeption->getMessage());
                            }
                        }
                        if (isset($_GET["id"])) {
                            $this->data["payment"] = PaymentManager::getPayment($_GET["id"]);
                            $this->view = "admin/editPayments";
                        } else {
                            $this->view = "admin/newPayments";
                        }
                    } else {
                        $this->view = 'admin/payments';
                        $this->data['payments'] = PaymentManager::getPayments();
                    }

                    break;
                case 'clients':
                    if (count($parameters) > 2 && $parameters[2] == "edit") {
                        if ($_POST) {
                            try {
                                $keys = array('fname', 'lname', 'email', 'street', 'town', 'pcode');
                                $client = array_intersect_key($_POST, array_flip($keys));
                                if (isset($_GET["id"])) {
                                    $id = $_GET["id"];
                                } else {
                                    $id = false;
                                }
                                UserManager::saveUser($id, $client);
                                $this->addMessage('Údaje byly změněny.');
                                $this->redirect('admin/client');
                            } catch (Throwable $exeption) {
                                $this->addMessage($exeption->getMessage());
                            }
                        }
                        if (isset($_GET["id"])) {
                            $this->data["client"] = UserManager::getUser($_GET["id"]);
                            $this->view = "admin/editClient";
                        } else {
                            $this->view = "admin/newClient";
                        }
                    } else {
                        $this->view = 'admin/clients';
                        $this->data['clients'] = UserManager::getUser();
                    }


                    $this->view = 'admin/clients';
                    $this->data['users'] = UserManager::getUsers();

                    break;
            }
        }


        $this->data['selectedCategory'] = CategoryManager::getCategory(1);
    }
}

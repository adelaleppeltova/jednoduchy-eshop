<?php


class RouterController extends Controller
{

    protected Controller $controller;


    private function parseURL(string $url): array
    {
        $parsedURL = parse_url($url);
        $parsedURL["path"] = ltrim($parsedURL["path"], "/");
        $parsedURL["path"] = trim($parsedURL["path"]);
        $splittedPath = explode("/", $parsedURL["path"]);
        return $splittedPath;
    }

    function process(array $parameters): void
    {
        $parsedURL = $this->parseURL($parameters[0]);

        $this->controller = new MainController();
        $this->view = 'layout';

        $userManager = new UserManager();
        $categories = CategoryManager::getCategories();
        $products = ProductManager::getProducts();
        $transports = TransportManager::getTransports();


        switch ($parsedURL[0]) {
            case "ucet":
                $this->controller = new AccountController();
                break;
            case "prihlasit":
            case "odhlasit":
                $this->controller = new LoginController();
                break;
            case "registrace":
                $this->controller = new RegisterController();
                break;
            case "admin":
                $this->controller = new AdminController($categories, $products, $transports);
                $this->view = 'admin';
                break;

            case 'kategorie':
                $this->controller = new CategoryController($categories);
        }




        $this->controller->process($parsedURL);

        $this->data['title'] = $this->controller->header['title'];
        $this->data['desc'] = $this->controller->header['desc'];
        $this->data['key_words'] = $this->controller->header['key_words'];
        $this->data['messages'] = $this->getMessages();
        $this->data['loggedin'] = $userManager->getUser();
        $this->data['categories'] = $categories;
        $this->data['products'] = $products;
        $this->data['basePath'] = $_SERVER['SERVER_NAME'];
    }
}

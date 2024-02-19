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

        switch ($parsedURL[0]) {
            case "ucet":
                $this->controller = new AccountController();
                break;
            case "prihlasit":
                $this->controller = new LoginController();
                break;
            case "registrace":
                $this->controller = new RegisterController();
                break;
        }



        $this->controller->process($parsedURL);

        $this->data['title'] = $this->controller->header['title'];
        $this->data['desc'] = $this->controller->header['desc'];
        $this->data['key_words'] = $this->controller->header['key_words'];
        $this->data['messages'] = $this->getMessages();
        $this->data['loggedin'] = false;


        $this->view = 'layout';
    }
}

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

        $this->controller = new HomepageController();

        $this->controller->process($parsedURL);

        $this->view = 'layout';
    }
}

<?php

session_start();

mb_internal_encoding("UTF-8");

function autoloadFunction(string $class): void
{
    if (preg_match('/Controller$/', $class))
        require("controllers/" . $class . ".php");
    else
        require("models/" . $class . ".php");
}

spl_autoload_register("autoloadFunction");

Db::connect("db.dw161.webglobe.com", "adela_janmatous", "u6OPU3wb", "janmatous_cz5");


$router = new RouterController();
$router->process(array($_SERVER['REQUEST_URI']));

$router->printView();

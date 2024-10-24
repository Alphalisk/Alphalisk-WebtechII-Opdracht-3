<?php

namespace controllers;

use http\Request;
use services\DatabaseContext;

class HomeController
{

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext
    )
    { }

    public function handle() {
        $homepage = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php') . file_get_contents('views/home.html');
        return $homepage;
    }
}
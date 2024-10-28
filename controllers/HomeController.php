<?php

namespace controllers;

//When someone visits the page a session is started
session_start();

use http\Request;
use http\Session;
use services\DatabaseContext;

class HomeController
{

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext,
        private Session $session
    )
    { }

    public function handle() {
        
        if ($this->session->hasSession()) {
            $navbar = file_get_contents('views/navbar.partial.logged.html');
        } else {
            $navbar = file_get_contents('views/navbar.partial.html');
        }

        $homepage = file_get_contents('views/head.partial.html') . $navbar . file_get_contents('views/home.html');
        return $homepage;
    }
}
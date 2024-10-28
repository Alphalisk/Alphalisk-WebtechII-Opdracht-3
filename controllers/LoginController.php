<?php

namespace controllers;

session_start();

use http\Request;
use http\Session;
use services\DatabaseContext;

class LoginController {
    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext,
        private Session $session
        )
    {}


    function handle() {
       if ($this->request->getRequestMethod() == 'POST') {
            $user = $this->databaseContext->getUser(
                $this->request->getPostValue('username'),
                $this->request->getPostValue('password')
            );

            if ($user) {

                $this->session->setSession($this->request->getPostValue('username'));

                $extra = "";
                $extra .= "<h1>Ingelogd</h1>";
            } else {
                $extra = '<div class="container-fluid text-center"><h4>De combinatie gebruikersnaam en wachtwoord is onjuist.</h4></div>';
            }

            $login = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.logged.html') . $extra;

            return $login;

        } else {
            $login = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.html') . file_get_contents('views/login.html');
            return $login;
        }
    }

}

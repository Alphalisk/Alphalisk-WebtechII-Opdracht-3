<?php

namespace controllers;

use http\Request;
use services\DatabaseContext;

class LoginController {
    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext)
    {}


    function handle() {
       if ($this->request->getRequestMethod() == 'POST') {
            $user = $this->databaseContext->getUser(
                $this->request->getPostValue('username'),
                $this->request->getPostValue('password')
            );

            if ($user) {
                $extra = "";
                $extra .= "<h1>Ingelogd</h1>";
                $extra .= "<h2>Welkom $user->username</h2>";
                $extra .= "<p>Emailadres is $user->email</p>";
            } else {
                $extra = '<div class="container-fluid text-center"><h4>De combinatie gebruikersnaam en wachtwoord is onjuist.</h4></div>';
            }

            $login = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php') . $extra;
            return $login;

        } else {
            $login = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php') . file_get_contents('views/login.html');
            return $login;
        }
    }

}

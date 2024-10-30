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

            $allusers = $this->databaseContext->getAllUserNames();
            $userExists = in_array($this->request->getPostValue('username'), $allusers, $strict = false);
            
            if ($userExists) {
                $user = $this->databaseContext->getUser(
                    $this->request->getPostValue('username'),
                    $this->request->getPostValue('password')
                );

                if ($user) {

                    $this->session->setSession($this->request->getPostValue('username'));
    
                    $extra = "  <div class=\"alert alert-success\">
                                    <strong>Succesvol ingelogd!</strong>
                                </div>";
                                $navbar = file_get_contents('views/navbar.partial.logged.html');
                                $navbar = str_replace('{{user}}', $this->session->getSession(), $navbar);
                } else {
                    $extra = "  <div class=\"alert alert-warning\">
                                    <strong>De combinatie gebruikersnaam en wachtwoord is onjuist.</strong>
                                </div>";
                                $navbar = file_get_contents('views/navbar.partial.html');
                }
                
            } else {
                $extra = "  <div class=\"alert alert-warning\">
                                <strong>De combinatie gebruikersnaam en wachtwoord is onjuist.</strong>
                            </div>";
                            $navbar = file_get_contents('views/navbar.partial.html');
            }

            $login = file_get_contents('views/head.partial.html') . $navbar . $extra;

            return $login;

        } else {
            $login = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.html') . file_get_contents('views/login.html');
            return $login;
        }
    }

}

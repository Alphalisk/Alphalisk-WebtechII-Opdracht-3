<?php

namespace controllers;

session_start();

use http\Request;
use http\Session;
use services\DatabaseContext;

class RegisterController
{
    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext,
        private Session $session)
    {}

    public function handle() {
        if ($this->request->getRequestMethod() == 'POST') {
            $user = $this->databaseContext->createUser(
                ...$this->request->getPostValuesAll(['username', 'email', 'password'])
            );

            if ($user) {
                $extra = "  <div class=\"alert alert-success\">
                                <strong>Succesvol geregistreerd!</strong> <br>Het is nu mogelijk om in te loggen.
                            </div>";
            } else {
                $extra = "<div class=\"alert alert-warning\">
                                <strong>Er is iets mis gegaan met het registreren.</strong>
                            </div>";
            }
            $users = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.html') . $extra;
            return $users;

        } else {
            $register = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.html') . file_get_contents('views/register.html');
            return $register;
        }

    }

}
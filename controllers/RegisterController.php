<?php

namespace controllers;

use http\Request;
use services\DatabaseContext;

class RegisterController
{
    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext)
    {}

    public function handle() {
        if ($this->request->getRequestMethod() == 'POST') {
            $user = $this->databaseContext->createUser(
                ...$this->request->getPostValuesAll(['username', 'email', 'password'])
                //$this->request->getPostValue('username'),
                //$this->request->getPostValue('email'),
                //$this->request->getPostValue('password')
            );

            if ($user) {
                $status = '<h1>Bijgewerkt hoor</h1>';
            } else {
                $status = '<h2>Alles is stuk</h2>';
            }
            $users = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php') . $status;
            return $users;

        } else {
            $register = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php') . file_get_contents('views/register.html');
            return $register;
        }

    }

}
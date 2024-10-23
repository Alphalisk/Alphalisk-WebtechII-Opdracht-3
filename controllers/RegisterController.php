<?php

namespace Controllers;

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
                return '<h1>aangemeld hoor</h1>';
            } else {
                return '<h2>Alles is stuk</h2>';
            }

        } else {
            return file_get_contents('views/register.html');
        }

    }

}
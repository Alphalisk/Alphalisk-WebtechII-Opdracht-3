<?php

namespace Controllers;

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
                print "<h1>Ingelogd</h1>";
                print "<h2>Welkom $user->username</h2>";
                print "<p>Emailadres is $user->email</p>";
            } else {
                print "<h1>Alles is stuk!</h1>";
            }
        } else {
            return file_get_contents('views/login.html');
        }
    }

}

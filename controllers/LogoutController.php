<?php

namespace controllers;

session_start();

use http\Request;
use http\Session;
use services\DatabaseContext;

class LogoutController {
    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext,
        private Session $session
        )
    {}

    function handle() {
        $this->session->closeSession($this->request->getPostValue('username'));
        $extra = "  <div class=\"alert alert-success\">
                        <strong>Succesvol uitgelogd!</strong>
                    </div>";

        $logout = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.html') . $extra;
        return $logout;
    }

}

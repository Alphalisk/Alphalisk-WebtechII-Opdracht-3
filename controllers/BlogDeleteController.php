<?php

namespace controllers;

session_start();

use http\Request;
use http\Session;
use services\DatabaseContext;

class BlogDeleteController {

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext,
        private Session $session)
    { }


    public function handle() {
        if ($this->request->getRequestMethod() == 'POST') {

            $this->databaseContext->deleteShare($this->request->getPostValue('delete'));

            $navbar = file_get_contents('views/navbar.partial.logged.html');
            $navbar = str_replace('{{user}}', $this->session->getSession(), $navbar);

            $delete = file_get_contents('views/head.partial.html') . $navbar;
            return $delete;

        }
    }
}
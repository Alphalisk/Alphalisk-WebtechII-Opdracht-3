<?php

namespace controllers;

session_start();

use http\Request;
use http\Session;
use services\DatabaseContext;

class BlogModifyController {

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext,
        private Session $session)
    { }


    public function handle() {
        if ($this->request->getRequestMethod() == 'POST') {
            $id = $this->request->getPostValue('id'); 
            $user_id = $this->request->getPostValue('user_id');      
            $title = $this->request->getPostValue('title');
            $body = $this->request->getPostValue('body');
            $link = $this->request->getPostValue('link');

            $this->databaseContext->modifyShare($id, $user_id, $title, $body, $link);

            $navbar = file_get_contents('views/navbar.partial.logged.html');
            $navbar = str_replace('{{user}}', $this->session->getSession(), $navbar);

            $extra = "<div class=\"alert alert-success\">
                                <strong>De share is succesvol gewijzigd.</strong>
                      </div>";

            $modify = file_get_contents('views/head.partial.html') . $navbar .$extra;
            return $modify;

        } 
    }
}
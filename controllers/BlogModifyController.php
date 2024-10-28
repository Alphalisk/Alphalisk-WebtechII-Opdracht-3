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

            $modify = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.logged.html');
            return $modify;

        } 
    }
}
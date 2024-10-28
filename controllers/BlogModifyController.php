<?php

namespace controllers;

use http\Request;
use services\DatabaseContext;

class BlogModifyController {

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext)
    { }


    public function handle() {
        if ($this->request->getRequestMethod() == 'POST') {
            $id = $this->request->getPostValue('id');       
            $title = $this->request->getPostValue('title');
            $body = $this->request->getPostValue('body');
            $link = $this->request->getPostValue('link');
            $user_id = $this->request->getPostValue('user_id');
            
            $this->databaseContext->modifyShare($id, $user_id, $title, $body, $link);

            $modify = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php');
            return $modify;

        } else {
            $modify = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php') . file_get_contents('views/modifyShare.partial.html');
            return $modify;
        }

    }
}
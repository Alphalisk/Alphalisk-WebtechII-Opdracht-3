<?php

namespace controllers;

session_start();

use http\Request;
use http\Session;
use services\DatabaseContext;

class BlogModifyViewController {

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext,
        private Session $session)
    { }


    public function handle() {
        

        if ($this->request->getRequestMethod() == 'POST') {
            
            $share = $this->databaseContext->getShare(
                $this->request->getPostValue('modify')
            );

            // $id = $share['id'];
            // $user_id = $share['user_id'];
            // $title = $share['title'];
            // $body = $share['body'];
            // $link = $share['link'];
            // $create_date = $share['create_date'];

            if ($this->request->getPreferredContentType()=='application/json') {
                return json_encode($share);
            }

            $html = '';
            for ($i = count($share)-1; $i >= 0  ; $i--) {// Omgedraaide blog van nieuw naar oud
                $html .= $share[$i]->toHtmlShare();
            }

            $shares = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.html') . file_get_contents('views/blogsModify.html'); // + file_get_contents('views/shares.partial.html')
            return str_replace('{{ data }}', $html, $shares);

        }
    }
}
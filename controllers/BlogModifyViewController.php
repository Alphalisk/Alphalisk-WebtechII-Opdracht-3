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

            if ($this->request->getPreferredContentType()=='application/json') {
                return json_encode($share);
            }

            $html = '';
            for ($i = count($share)-1; $i >= 0  ; $i--) {
                $html .= $share[$i]->toHtmlShare();
            }

            $shares = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.logged.html') . file_get_contents('views/blogsModify.html'); // + file_get_contents('views/shares.partial.html')
            return str_replace('{{ data }}', $html, $shares);

        }
    }
}
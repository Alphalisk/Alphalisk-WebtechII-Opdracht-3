<?php

namespace controllers;

session_start();

use http\Request;
use http\Session;
use services\DatabaseContext;

class ShareController {

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext,
        private Session $session)
    { }


    public function handle() {
        

        if ($this->request->getRequestMethod() == 'POST') {

            $share = $this->databaseContext->createShare(...$this->request->getPostValuesAll(['user_id','title', 'body', 'link']));
        
            $extra = "<div class=\"alert alert-success\">
                            <strong>De share is succesvol aangemaakt.</strong>
                    </div>";

            $navbar = file_get_contents('views/navbar.partial.logged.html');
            $navbar = str_replace('{{user}}', $this->session->getSession(), $navbar);

            $shares = file_get_contents('views/head.partial.html') . $navbar . $extra;
            return $shares;

            

        } else {
            $navbar = file_get_contents('views/navbar.partial.logged.html');
            $navbar = str_replace('{{user}}', $this->session->getSession(), $navbar);
            
            $shares = file_get_contents('views/head.partial.html') . $navbar . file_get_contents('views/share.partial.html');
            return $shares;
        }
    }
}
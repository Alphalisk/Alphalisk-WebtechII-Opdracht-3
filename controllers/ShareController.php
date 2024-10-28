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

            $share = $this->databaseContext->createShare(...$this->request->getPostValuesAll(['user_id','title', 'body', 'link']));//...$this->request->getPostValuesAll(['title', 'body', 'link'])
        
            if ($share) {
                $status = '<h1>Bijgewerkt hoor</h1>';
            } else {
                $status = '<h2>Alles is stuk</h2>';
            }
            $shares = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.logged.html') . $status;
            return $shares;

            

        } else {
            $shares = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.html') . file_get_contents('views/share.partial.html'); // + file_get_contents('views/shares.partial.html')
            return $shares;
        }
    }
}
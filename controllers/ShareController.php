<?php

namespace controllers;

use http\Request;
use services\DatabaseContext;

class ShareController {

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext)
    { }


    public function handle() {
        

        if ($this->request->getRequestMethod() == 'POST') {
            
            $share = $this->databaseContext->createShare(...$this->request->getPostValuesAll(['title', 'body', 'link','user_id']));                //...$this->request->getPostValuesAll(['title', 'body', 'link'])
        
            if ($share) {
                $status = '<h1>Bijgewerkt hoor</h1>';
            } else {
                $status = '<h2>Alles is stuk</h2>';
            }
            $shares = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.html') . $status;
            return $shares;

            

        } else {
            $shares = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.html') . file_get_contents('views/share.partial.html'); // + file_get_contents('views/shares.partial.html')
            return $shares;
        }
    }
}
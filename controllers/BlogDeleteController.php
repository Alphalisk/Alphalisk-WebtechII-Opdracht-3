<?php

namespace controllers;

use http\Request;
use services\DatabaseContext;

class BlogDeleteController {

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext)
    { }


    public function handle() {
        if ($this->request->getRequestMethod() == 'POST') {
            $this->databaseContext->deleteShare(
                //...$this->request->getPostValuesAll(['username', 'email', 'password'])
                $this->request->getPostValue('delete')
                //$this->request->getPostValue('email'),
                //$this->request->getPostValue('password')
            );

            // if ($id) {
            //     $status = '<h1>Bijgewerkt hoor</h1>';
            // } else {
            //     $status = '<h2>Alles is stuk</h2>';
            // }
            $delete = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php');
            return $delete;

        } else {
            $delete = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php') . file_get_contents('views/home.html');
            return $delete;
        }

    }
}
<?php

namespace controllers;

use http\Request;
use services\DatabaseContext;

class ModifyViewController {

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext)
    { }


    public function handle() {
        

        if ($this->request->getRequestMethod() == 'POST') {
            
            $id = $this->request->getPostValue('id');                //...$this->request->getPostValuesAll(['title', 'body', 'link'])
            $title = $this->request->getPostValue('title'); 
            $link = $this->request->getPostValue('link'); 
            $user_id = $this->request->getPostValue('user_id'); 

            $shares = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php') . file_get_contents('views/modifyShare.partial.html'); // + file_get_contents('views/shares.partial.html')
            return $shares;

            

        }
    }
}
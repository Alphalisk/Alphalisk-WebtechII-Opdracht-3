<?php

namespace controllers;

session_start();

use http\Request;
use http\Session;
use services\DatabaseContext;

class BlogController {

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $ctx,
        private Session $session)
    { }


    public function handle() {
        
        
        $blogs = $this->ctx->getBlogs();

        if ($this->request->getPreferredContentType()=='application/json') {
            return json_encode($blogs);
        }

        $html = '';
        for ($i = count($blogs)-1; $i >= 0  ; $i--) {// Omgedraaide blog van nieuw naar oud
            $html .= $blogs[$i]->toHtml();
        }

        if ($this->session->hasSession()) {
            $navbar = file_get_contents('views/navbar.partial.logged.html');
        } else {
            $navbar = file_get_contents('views/navbar.partial.html');
        }

        $blogs = file_get_contents('views/head.partial.html') . $navbar . file_get_contents('views/blogs.html');
        return str_replace('{{ data }}', $html, $blogs);
    }
}
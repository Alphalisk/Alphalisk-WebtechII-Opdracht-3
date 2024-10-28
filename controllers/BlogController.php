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

        

        // Flexibele navbar die anders is wanneer een user is ingelogd.
        if ($this->session->hasSession()) {
            $navbar = file_get_contents('views/navbar.partial.logged.html');
            $navbar = str_replace('{{user}}', $this->session->getSession(), $navbar);

            $html = '';
            for ($i = count($blogs)-1; $i >= 0  ; $i--) {// Omgedraaide blog van nieuw naar oud
                $html .= $blogs[$i]->toHtmlLogged();
            }

            $share = file_get_contents('views/blogs.logged.html');
        } else {
            $navbar = file_get_contents('views/navbar.partial.html');

            $html = '';
            for ($i = count($blogs)-1; $i >= 0  ; $i--) {// Omgedraaide blog van nieuw naar oud
                $html .= $blogs[$i]->toHtml();
            }

            $share = file_get_contents('views/blogs.html');
        }

        $blogs = file_get_contents('views/head.partial.html') . $navbar . $share;
        return str_replace('{{ data }}', $html, $blogs);
    }
}
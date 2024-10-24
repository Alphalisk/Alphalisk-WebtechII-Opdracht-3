<?php

namespace controllers;

use http\Request;
use services\DatabaseContext;

class BlogModifyController {

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $ctx)
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
        $blogs = file_get_contents('views/head.partial.html') . file_get_contents('views/navbar.partial.php') . file_get_contents('views/blogs.html');
        return str_replace('{{ data }}', $html, $blogs);
    }
}
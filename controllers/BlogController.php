<?php

namespace Controllers;

use http\Request;
use services\DatabaseContext;

class BlogController {

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
        for ($i = 0; $i < count($blogs)  ; $i++) {
            $html .= $blogs[$i]->toHtml();
        }

        $blogs = file_get_contents('views/blogs.html');
        return str_replace('{{ data }}', $html, $blogs);
    }
}
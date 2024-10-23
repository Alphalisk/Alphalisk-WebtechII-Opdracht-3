<?php

namespace Controllers;

use http\Request;
use services\DatabaseContext;

class EchoController
{

    public function __construct(
        private readonly Request $request,
        private DatabaseContext $databaseContext
    )
    { }

    public function handle() {
        return file_get_contents('views/home.html');
    }
}
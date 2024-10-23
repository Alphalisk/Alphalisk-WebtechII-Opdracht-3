<?php

namespace models;

class User
{
    public function __construct(
        public readonly string $username,
        public readonly string $email,
    ){}

}
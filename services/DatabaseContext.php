<?php

namespace services;

use models\Blog;
use models\User;

class DatabaseContext {
    private \SQLite3 $handler;

    public function __construct()
    {
        $this->handler =  new \SQLite3('data.sqlite3');
    }

    public function getHandler(): \SQLite3
    {
        return $this->handler;
    }

    public function getBlogs(): array
    {
        $returnvalue = [];
        $results = $this->handler->query("select * from blogs");
        while ($row = $results->fetchArray()) {
            $returnvalue[] = new Blog(
                $row['image'],
                $row['titel'],
                $row['datum']
            );
        }

        return $returnvalue;
    }

    public function getUser(string $username, string $password): ?User {
        $result = $this->handler->query("select * from users where username='$username'");
        $row = $result->fetchArray();
        $opgeslagen_wachtwoord = $row['password'];

        if (password_verify($password, $opgeslagen_wachtwoord)) {
            return new User($row['username'], $row['email']);
        }

        return null;
    }

    public function createUser(string $username, string $email, string $password): ?User {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "insert into users(username,password, email) values ('$username', '$password', '$email')";
        $this->handler->exec($sql);
        return new User ($username, $email);
    }
}
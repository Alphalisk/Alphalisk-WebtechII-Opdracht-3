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
        $results = $this->handler->query("select * from shares");

        while ($row = $results->fetchArray()) {
            $returnvalue[] = new Blog(
                $row['id'],
                $row['user_id'],
                $row['title'],
                $row['body'],
                $row['link'],
                $row['create_date']                
            );
            
        
        }

        return $returnvalue;
    }

    public function getUserID(string $username) {
        $result = $this->handler->query("select * from users where username='$username'");
        $row = $result->fetchArray();
        $id = $row['id'];

        return $id;
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
        $sql = "insert into users(username,password, email,register_date) values ('$username', '$password', '$email',CURRENT_TIMESTAMP)";
        $this->handler->exec($sql);
        return new User ($username, $email);
    }

    public function getShare(string $id) {
        $result = $this->handler->query("select * from shares where id='$id'");
        $row = $result->fetchArray();

        $returnvalue[] = new Blog(
            $row['id'],
            $row['user_id'],
            $row['title'],
            $row['body'],
            $row['link'],
            $row['create_date']                
        );

        return $returnvalue;
    }

    public function createShare(string $user_id,string $title, string $body, string $link) {
        $sql = "insert into shares(user_id, title,body, link,create_date) values ('$user_id','$title', '$body', '$link',CURRENT_TIMESTAMP)";
        $this->handler->exec($sql);
        return ;
    }

    public function deleteShare(int $id) {
        $sql = "DELETE FROM shares WHERE id='$id';";
        $this->handler->exec($sql);
        return ;
    }

    public function modifyShare(string $id, string $user_id ,string $title, string $body, string $link) {
        $sql = "UPDATE shares SET user_id = '$user_id', title = '$title',body = '$body', link = '$link',create_date = CURRENT_TIMESTAMP WHERE id='$id'";
        $this->handler->exec($sql);
        return ;
    }
}
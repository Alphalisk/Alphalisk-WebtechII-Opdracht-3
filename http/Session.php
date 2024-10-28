<?php

namespace http;

class Session
{
    public function getSession()
    {
        if (!empty($_SESSION['username']));{
            return $_SESSION['username'];
        }
    }

    public function setSession(string $user_id) 
    {
        $_SESSION['username'] = $user_id;
        return;
    }

    public function hasSession()
    {
        if (!empty($_SESSION['username'])) {
            return true;
        } else {
            return false;
        }
    }

    public function closeSession()
    {
        session_destroy();
    }

}
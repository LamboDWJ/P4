<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class UserManager extends Manager
{
    /* Recuperation de l'utilisateur et son password */

    public function getUser()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, username, password FROM users');
        $user = $req->fetch();

        return $user;
    }
    
}

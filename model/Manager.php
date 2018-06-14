<?php

namespace OpenClassrooms\Blog\Model;

class Manager
{
    
    /* Connexion à la BDD */

    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        return $db;
    }
}
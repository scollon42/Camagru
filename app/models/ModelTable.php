<?php

namespace App\Models;

// This class will be used as a factory fore other Table

class ModelTable
{
    private $table = [];

    public function __construct()
    {
        $this->table['users'] = new UsersTable();
        $this->table['comments'] = new CommentsTable();
        $this->table['gallery'] = new GalleryTable();
    }

    public function getTable($key)
    {
        if (isset($this->table[$key]))
            return ($this->table[$key]);
        return (False);
    }

    public function __get($key)
    {
        return ($this->getTable($key));
    }

}


?>
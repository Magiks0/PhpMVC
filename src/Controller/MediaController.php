<?php

namespace App\Controller;

use App\Database\Database;
use App\Database\MediaDatabase;

class MediaController extends AbstractController
{
    public function index()
    {
        Database::Connect();
        $medias = MediaDatabase::findAll();
        return $this->render('catalog/index.html', [
            'medias' => $medias
        ]);
    }

    
}
?>
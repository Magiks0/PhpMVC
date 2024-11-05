<?php

namespace App\Controller;

use App\Database\Database;
use App\Database\MediaDatabase;
use App\Model\Media;

class HomeController extends AbstractController
{
    public function index()
    {
        Database::Connect();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $searchCriteria = $_POST['search'];
            $medias = MediaDatabase::findBySearch($searchCriteria);
        } else {
            $medias = MediaDatabase::findAll();
        }

        return $this->render('home/index.html.php', [
            'medias' => $medias,
        ]);
    }


    public function changeAvailable()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['media_id'])) {
            $mediaId = intval($_POST['media_id']);
            MediaDatabase::changeAvailable($mediaId);
            header('Location: /'); // Redirige l'utilisateur vers la page précédente
            exit;
        } else {
            echo "Requête invalide";
        }
    }
}
?>
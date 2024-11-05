<?php 

namespace App\Database;

use App\Model\Media;
use Exception;
use PDO;

class MediaDatabase
{

    public static function findAll(): array
    {
        $connection = Database::Connect();

        $query = sprintf("SELECT * FROM media");

        $query = $connection->prepare($query);
        $query->execute();

        $results = $query->fetchAll();

        $medias = [];

        foreach ($results as $result) {
            $medias[] = Media::fromArray($result);
        }
        return $medias;
    }

    public static function add(Media $media): bool
    {
        $connexion = Database::Connect();
        $request = $connexion->prepare('INSERT INTO media (name) VALUES (:name);');
        $request->bindParam('name', $media);
        return $request->execute();
    }

    public static function findBySearch()
    {
        if (isset($_POST['search'])) {
            $searchCriteria = $_POST['search'];

            $pdo = Database::connect();

            switch ($searchCriteria) {
                case 'available':
                    $sql = "SELECT title, author, available FROM media WHERE available = 1";
                    break;
                case 'movie':
                    $sql = "SELECT title, author, available FROM media me JOIN movies mo ON mo.media_id = me.id";
                    break;
                case 'book':
                    $sql = "SELECT title, author, available FROM media me JOIN books bo ON bo.media_id = me.id";
                    break;
                case 'album':
                    $sql = "SELECT title, author, available FROM media me JOIN albums al ON al.media_id = me.id";
                    break;
                default:
                    $sql = "SELECT * FROM media"; // Toutes les entrées
                    break;
            }

            // Préparation et exécution de la requête
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            // Récupération des résultats
            $results = $stmt->fetchAll();

            foreach ($results as $result) {
                $medias[] = Media::fromArray($result);
            }

            return $medias;
        }
    }


    public static function modify(): bool
    {
        $connexion = Database::Connect();
        $request = $connexion->prepare('UPDATE team SET name = :name WHERE id = :id');
        $request->bindValue('name', $_POST['name']);
        
        $request->bindValue(':id', $_GET['id']);

        return $request->execute();
    }

    public static function delete(): bool
    {
        $connexion = Database::Connect();
        $request = $connexion->prepare('DELETE FROM team WHERE id = :id');
        $request->bindValue('id', $_GET['id']);

        return $request->execute();
    }

    public static function changeAvailable($mediaId)
{
    $connection = Database::Connect();

    // Récupération de la disponibilité actuelle
    $query = $connection->prepare('SELECT available FROM media WHERE id = :id');
    $query->bindParam(':id', $mediaId, PDO::PARAM_INT);

    if (!$query->execute()) {
        throw new Exception("Erreur lors de l'exécution de la requête : " . implode(", ", $query->errorInfo()));
    }

    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    // Vérifiez si un résultat a été trouvé
    if ($result === false) {
        throw new Exception("Aucun média trouvé avec l'ID : " . $mediaId);
    }

    // Debug: Afficher la disponibilité actuelle
    error_log("Disponibilité actuelle: " . $result['available']); // Ajoute à votre log d'erreurs

    $newAvailability = $result['available'] ? 0 : 1;

    // Mise à jour de la disponibilité
    $updateQuery = $connection->prepare('UPDATE media SET available = :available WHERE id = :id');
    $updateQuery->bindParam(':available', $newAvailability, PDO::PARAM_INT);
    $updateQuery->bindParam(':id', $mediaId, PDO::PARAM_INT);
    
    if (!$updateQuery->execute()) {
        throw new Exception("Erreur lors de la mise à jour de la disponibilité : " . implode(", ", $updateQuery->errorInfo()));
    }

    // Debug: Afficher la nouvelle disponibilité
    error_log("Nouvelle disponibilité: " . $newAvailability); // Ajoute à votre log d'erreurs
}


}

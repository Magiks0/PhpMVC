<?php

namespace App\Controller;

use App\Database\Database;

class UserController extends AbstractController
{
    public function login()
    {
        // Si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            try {
                // Validation basique
                if (empty($email) || empty($password)) {
                    throw new \Exception('Email et mot de passe requis');
                }

                // Connexion à la base de données et vérification des identifiants
                $pdo = Database::Connect();
                $stmt = $pdo->prepare('SELECT * FROM user WHERE email = ?');
                $stmt->execute([$email]);
                $user = $stmt->fetch(\PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    // Connexion réussie
                    session_start();
                    $_SESSION['user'] = $user;
                    $this->redirectToUrl('/');
                    return;
                }

            } catch (\Exception $e) {
                // En cas d'erreur, on affiche la page de login avec le message d'erreur
                return $this->render('user/login.html.php', [
                    'error' => $e->getMessage(),
                    'user' => $user
                ]);
            }
        }

        // Affichage du formulaire
        return $this->render('user/login.html.php');
    }

    public function register()
    {
        // Si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_ARGON2ID);

            try {
                // Validation basique
                if (empty($email) || empty($password)) {
                    throw new \Exception('Email et mot de passe requis');
                }

                // Connexion à la base de données et vérification des identifiants
                $pdo = Database::Connect();
                $stmt = $pdo->prepare('INSERT INTO user VALUES (id, :email, :username, :password)');
                $stmt->bindParam('email', $email);
                $stmt->bindParam('username', $username);
                $stmt->bindParam('password', $password);
                $stmt->execute();

                return $this->render('user/register.html.php', [
                    'success' => 'Enregistrement effectué',
                ]);

            } catch (\Exception $e) {
                // En cas d'erreur, on affiche la page de login avec le message d'erreur
                return $this->render('user/register.html.php', [
                    'error' => $e->getMessage(),
                ]);
            }
        }

        // Affichage du formulaire
        return $this->render('user/register.html.php');
    }

    public function logout()
    {
        session_start();

        // Détruire la session
        session_unset();
        session_destroy();

        // Rediriger vers la page de connexion
        header("Location: /login");
        exit;
    }
}
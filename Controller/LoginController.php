<?php

Class LoginController{
    private $userController;
    private $user;

    private $db;

    public function __construct($db1){
        require_once ('./Entity/UserEntity.php');
        require_once ('./Controller/UserController.php');
        $this->userController = new UserController($db1);
        $this->db = $db1;
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données envoyées
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Vérification avec doLogin
            if ($this->doLogin(['email' => $email, 'password' => $password])) {
                header('Location: /tp/index.php?ctrl=user&action=view');
                exit;
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        } else {
            include('./View/login/loginForm.php');
        }
    }


    public function index()
    {
        include('./View/login/loginForm.php');
    }

    public function doLogin(array $array): bool
    {
        if (empty($array['email']) || empty($array['password'])) {
            echo "Veuillez remplir tous les champs.";
            return false;
        }

        $user = $this->getVerification($array['email'], $array['password']);
        if (!$user) {
            echo "Email ou mot de passe incorrect.";
            return false;
        }

        return $this->saveSession($user);
    }


    public static function uncrypt(string $passwordPost, string $passwordDb): bool
    {
        return password_verify($passwordPost, $passwordDb);
    }

    private function getVerification($email, $password): UserEntity|bool
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        // Récupérer les résultats
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Vérifier si l'utilisateur existe
        if (!$user) {
            echo 'Email incorrect.';
            return false;
        }

        // Vérifier le mot de passe haché
        if ($this->uncrypt($password, $user['password'])) {
            // Créer une instance de UserEntity avec les données de l'utilisateur
            $userEntity = new UserEntity();
            $userEntity->setLastName($user['lastName']);
            $userEntity->setFirstName($user['firstName']);
            $userEntity->setEmail($user['email']);
            $userEntity->setAddress($user['address']);
            $userEntity->setPostalCode($user['postalCode']);
            $userEntity->setCity($user['city']);
            $userEntity->setCountry($user['country']);

            return $userEntity;
        }

        echo "Mot de passe incorrect.";
        return false;
    }


    private function saveSession(UserEntity $user): bool
    {
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['admin'] = $user->getAdmin();


        return true;
    }

    public function logout()
    {
        // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Détruire toutes les données de session
        $_SESSION = []; // Vider le tableau $_SESSION
        session_unset(); // Supprime toutes les variables de session
        session_destroy(); // Détruit la session elle-même

        // Redirection vers la page d'accueil ou une autre page
        header('Location: /tp/index.php?ctrl=home&action=index');
        exit;
    }
}

<?php

require_once '/Applications/MAMP/htdocs/tp/Entity/UserEntity.php';


class UserController
{

    private $db;

    public function __construct($db1)
    {
        $this->db = $db1;
    }

    public function login(User $user)
    {
// A compléter
        // return $req->fetch();
    }

    public function createForm()
    {
        include('./View/user/form.php');
    }

    public function createUser(UserEntity $user)
    {
        $req = $this->db->prepare(
            'INSERT INTO users (lastName, firstName, email, address, postalCode, city, country, password, admin)
         VALUES (:lastName, :firstName, :email, :address, :cp, :city, :country, :password, 0)'
        );

        $req->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $req->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':address', $user->getAddress(), PDO::PARAM_STR);
        $req->bindValue(':cp', $user->getPostalCode(), PDO::PARAM_STR);
        $req->bindValue(':city', $user->getCity(), PDO::PARAM_STR);
        $req->bindValue(':country', $user->getCountry(), PDO::PARAM_STR);
        $req->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);

        $req->execute();
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new UserEntity();
            $user->setFirstName($_POST['firstName']);
            $user->setLastName($_POST['lastName']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setAddress($_POST['address']);
            $user->setPostalCode($_POST['postalCode']);
            $user->setCity($_POST['city']);
            $user->setCountry($_POST['country']);

            // Insérer l'utilisateur dans la base de données
            $this->createUser($user);
            $_SESSION['message'] = "Utilisateur créé avec succès!";

            // Redirection après la création
            header('Location: index.php?ctrl=user&action=view');
            exit();
        }
    }


    public function index()
    {
        ///récupération des users
        $usersData = $this->findAll();
        // Création d'un tableau d'objets UserEntity
        $users = [];
        foreach ($usersData as $userData) {
            // Créer un objet UserEntity pour chaque utilisateur et ajouter au tableau
            $user = new UserEntity();
            $user->hydrate($userData); // utilisation de hydrate pour set les données
            $users[] = $user;
        }

        return $users;
    }


    public function findAll()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();

    }


    public final function findOne($id)
    {
        $req = $this->db->prepare(
            'SELECT * FROM users WHERE id = :id'
        );
        $req->execute();
        return $req->fetch();
    }

    public final function update(UserEntity $user)
    {
        $req = $this->db->prepare(
            'UPDATE users SET 
            lastName = :lastName, 
            firstName = :firstName, 
            email = :email, 
            address = :address, 
            postalCode = :cp, 
            city = :city, 
            password = :password, 
            admin = :admin 
        WHERE id = :id'
        );

        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $req->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':address', $user->getAddress(), PDO::PARAM_STR);
        $req->bindValue(':cp', $user->getPostalCode(), PDO::PARAM_STR);
        $req->bindValue(':city', $user->getCity(), PDO::PARAM_STR);
        $req->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete()
    {
        if (isset($_POST['deleteId'])) {
            $deleteId = $_POST['deleteId'];
            $this->deleteUserById($deleteId);
            $_SESSION['message'] = "Utilisateur supprimé avec succès !";
            header('Location: /tp/index.php?ctrl=user&action=view');
            exit();
        } else {
            echo "ID manquant pour la suppression";
        }
    }

    public final function deleteUserById(int $userId)
    {
        $req = $this->db->prepare(
            'DELETE FROM users WHERE id = :id'
        );

        $req->bindValue(':id', $userId, PDO::PARAM_INT);

        $req->execute();
    }

    public function view()
    {
        $users = $this->index();
        include('./View/user/index.php');
    }

    public function handleRequest()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';

        switch ($action) {
            case 'createForm':
                $this->createForm();
                break;
            case 'create':
                $this->create();
                break;
            case 'delete':
                $this->delete();
                break;
            case 'view':
            default:
                return $this->index();

        }
    }

}
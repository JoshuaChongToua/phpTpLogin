<?php
class HomeController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        echo "Bienvenue sur la page d'accueil.";
    }
}

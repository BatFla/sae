<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/model/membre.php';

class MembreController
{

    private $model;

    function __construct()
    {
        $this->model = 'Membre';
    }

    public function createMembre($email, $mdp, $tel, $adresseId, $pseudo, $prenom, $nom)
    {
        $membreID = $this->model::createCompte($email, $mdp, $tel, $adresseId, $pseudo, $prenom, $nom);
        return $membreID;
    }

    public function getInfosMembre($id)
    {
        $membre = $this->model::getMembreById($id);
        return $membre;
    }

    public function getMdpMembre($id)
    {
        $membre = $this->model::getMdpById($id);

        if ($membre) {
            $result = $membre["mdp_hash"];
        } else {
            return false;
        }

        return $result;
    }

    public function updateMembre($id, $email = false, $mdp = false, $tel = false, $adresseId = false, $pseudo = false, $prenom = false, $nom = false)
    {
        if ($email === false && $mdp === false && $tel === false && $adresseId === false && $pseudo === false && $prenom === false && $nom === false) {
            echo "ERREUR: Aucun champ à modifier";
            return -1;
        } else {
            $membre = $this->model::getMembreById($id);

            $updatedMembreId = $this->model::updateMembre(
                $id,
                $email !== false ? $email : $membre["email"],
                $mdp !== false ? $mdp : $membre["mdp_hash"],
                $tel !== false ? $tel : $membre["num_tel"],
                $adresseId !== false ? $adresseId : $membre["id_adresse"],
                $pseudo !== false ? $pseudo : $membre["pseudo"],
                $prenom !== false ? $prenom : $membre["prenom"],
                $nom !== false ? $nom : $membre["nom"]
            );
            return $updatedMembreId;
        }
    }

    public function deleteMembre($id)
    {
        $membre = $this->model::deleteMembre($id);

        return $membre;
    }
}
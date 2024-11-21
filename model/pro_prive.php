<?php

class ProPrive extends BDD {

    private $nom_table = "_pro_prive";

    static function createProPrive($email, $mdp, $tel, $adresseId, $nomPro, $num_siren) {
        $query = "INSERT INTO (email, mdp_hash, num_tel, adresse_id, nomPro, num_siren". self::$nom_table ."VALUES (?, ?, ?, ?, ?, ?) RETURNING id_compte";
        $statement = self::$db->prepare($query);
        $statement->bindParam(1, $email);
        $statement->bindParam(2, $mdp);
        $statement->bindParam(3, $tel);
        $statement->bindParam(4, $adresseId);
        $statement->bindParam(5, $nomPro);
        $statement->bindParam(6, $num_siren);
        
        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "ERREUR: Impossible de créer le compte pro privé";
            return -1;
        }
    }

    static function getProPriveById($id){
        self::initBDD();
        $query = "SELECT * FROM " . self::$nom_table ." WHERE compte_id = ?";
        $statement = self::$db->prepare($query);
        $statement->bindParam(1, $id);

        if ($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "ERREUR";
            return false;
        }
    }
    
    static function updateProPrive($id, $email, $mdp, $tel, $adresseId, $nomPro, $num_siren) {
        self::initBDD();
        $query = "UPDATE " . self::$nom_table . " SET email = ?, mdp_hash = ?, num_tel = ?, id_adresse = ?, $nomPro = ?, num_siren = ? WHERE id_compte = ?";
        $statement = self::$db->prepare($query);
        $statement->bindParam(1, $email);
        $statement->bindParam(2, $mdp);
        $statement->bindParam(3, $tel);
        $statement->bindParam(4, $adresseId);
        $statement->bindParam(5, $nomPro);
        $statement->bindParam(6, $num_siren);
        $statement->bindParam(7, $id);

        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "ERREUR: Impossible de mettre à jour le compte pro privé";
            return -1;
        }
    }

    static function deleteProPrive($id) {
        self::initBDD();
        $query = "DELETE FROM". self::$nom_table ."WHERE id_compte = ?";

        $statement = self::$db->prepare($query);
        $statement->bindParam(1, $id);

        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "ERREUR: Impossible de supprimer le compte pro privé";
            return -1;
        }
    }
}
?>
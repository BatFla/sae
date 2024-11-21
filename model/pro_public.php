<?php

class ProPublic extends BDD {

    private $nom_table = "_pro_public";

    static function createProPublic($email, $mdp, $tel, $adresseId, $nomPro, $type_orga) {
        $query = "INSERT INTO (email, mdp_hash, num_tel, adresse_id, nomPro, type_orga". self::$nom_table ."VALUES (?, ?, ?, ?, ?, ?) RETURNING id_compte";
        $statement = self::$db->prepare($query);
        $statement->bindParam(1, $email);
        $statement->bindParam(2, $mdp);
        $statement->bindParam(3, $tel);
        $statement->bindParam(4, $adresseId);
        $statement->bindParam(5, $nomPro);
        $statement->bindParam(6, $type_orga);
        
        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "ERREUR: Impossible de créer le compte pro public";
            return -1;
        }
    }

    static function getProPublicById($id){
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
    
    static function updateProPublic($id, $email, $mdp, $tel, $adresseId, $nomPro, $type_orga) {
        self::initBDD();
        $query = "UPDATE " . self::$nom_table . " SET email = ?, mdp_hash = ?, num_tel = ?, id_adresse = ?, $nomPro = ?, type_orga = ? WHERE id_compte = ?";
        $statement = self::$db->prepare($query);
        $statement->bindParam(1, $email);
        $statement->bindParam(2, $mdp);
        $statement->bindParam(3, $tel);
        $statement->bindParam(4, $adresseId);
        $statement->bindParam(5, $nomPro);
        $statement->bindParam(6, $type_orga);
        $statement->bindParam(7, $id);

        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "ERREUR: Impossible de mettre à jour le compte pro public";
            return -1;
        }
    }

    static function deleteProPublic($id) {
        self::initBDD();
        $query = "DELETE FROM". self::$nom_table ."WHERE id_compte = ?";

        $statement = self::$db->prepare($query);
        $statement->bindParam(1, $id);

        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "ERREUR: Impossible de supprimer le compte pro public";
            return -1;
        }
    }
}
?>
<?php
/**
 * Description of Offers
 *
 * @author rozan_000
 */
class OffersModel extends Model {
    
    /**
     * listOffres()
     * Liste les offres
     */
    public function listOffres($depart, $arrivee)
    {
        $query = "SELECT * FROM offre WHERE villeDepart = ? OR villeArrivee = ?";
        $result = $this->dbQuery($query, array($depart, $arrivee))->fetchAll();
        
        return $result;
    }
    
    /**
     * listMesOffres()
     * Liste les offres créées par l'utilisateur
     */
    public function listMesOffres()
    {
        $query = "SELECT * FROM offre WHERE idUser = ?";
        $result = $this->dbQuery($query, array($_SESSION["uid"]))->fetchAll();

        return $result;
    }
    
    /**
     * listDetailOffre()
     * Affiche les détails d'une offre sélectionnée
     */
    public function listDetailOffre($id)
    {
        $query = "
            SELECT * 
            FROM user u, offre o, ramassagesparoffre ro, ramassage r 
            WHERE o.idUser = u.id AND ro.idOffre = o.id AND ro.idRamassage = r.id AND o.id = ?
        ";
        
        $result = $this->dbQuery($query, array($id))->fetchAll();
        
        if (!$result) {
            $query = "
                SELECT * 
                FROM user u, offre o 
                WHERE o.idUser = u.id AND o.id = ?
            ";

            $result = $this->dbQuery($query, array($id))->fetchAll();
        }
        
        return $result;
    }
    
    /**
     * listPassagerOffre()
     * Liste des passagers d'une offre
     */
    public function listPassagerOffre($id)
    {
        $query = "
            SELECT p.id, p.nom, p.prenom, p.adresse, p.codePostal, p.ville, p.email, p.tel 
            FROM offre o, passagersparoffre po, passager p 
            WHERE po.idOffre = o.id AND po.idPassager = p.id AND o.id = ?
        ";
        
        $result = $this->dbQuery($query, array($id))->fetchAll();
        
        return $result;
    }
    
    /**
     * listPassagerRamassage()
     * Liste des passagers d'un ramassage d'une offre
     */
    public function listPassagerRamassage($id)
    {
        $query = "
            SELECT r.id, p.nom, p.adresse, p.codePostal, p.ville, p.prenom, p.email, p.tel 
            FROM offre o, ramassagesparoffre ro, ramassage r, passagersparramassage pr, passager p 
            WHERE ro.idOffre = o.id 
            AND ro.idRamassage = r.id 
            AND pr.idRamassage = r.id 
            AND pr.idPassager = p.id 
            AND o.id = ?
        ";
        
        $result = $this->dbQuery($query, array($id))->fetchAll();
        
        return $result;
    }
    
    /**
     * listMesOffresAModifier()
     * Affichage dans la formulaire de modification d'une offre
     */
    public function listMesOffresAModifier($id)
    {
        $query = "SELECT * FROM offre WHERE id = ?";
        $result = $this->dbQuery($query, array($id))->fetch();
        
        return $result;
    }
    
    /**
     * updateOffre()
     * Modification d'une offre dans la BDD
     */
    public function updateOffre($jour, $date, $heure, $depart, $arrivee, $id)
    {
        $query = "UPDATE offre SET jour=?, date=?, heure=?, villeDepart=?, villeArrivee=? WHERE id=?";
        $this->dbQuery($query, array($jour, $date, $heure, $depart, $arrivee, $id));
    }
    
    /**
     * deleteOffre()
     * Suppression d'une offre dans la BDD
     */
    public function deleteOffre($id)
    {
        $query = "DELETE FROM offre WHERE id = ?";
        $this->dbQuery($query, array($id));
    }
    
    /**
     * listRamassageParOffre()
     * Affichage des ramassages d'une offre
     */
    public function listRamassageParOffre($id)
    {
        $query = "SELECT o.id as idOffre, r.id as idRam "
                . "FROM offre o, ramassage r, ramassagesparoffre ro "
                . "WHERE ro.idOffre = o.id "
                . "AND ro.idRamassage = r.id "
                . "AND o.id = ?";
        
        $result = $this->dbQuery($query, array($id))->fetchAll();
        return $result;
    }
    
    /**
     * deleteRamassage()
     * Suppression des ramassages d'une offre dans la BDD
     */
    public function deleteRamassage($id)
    {
        $query = "DELETE FROM ramassage WHERE id = ?";
        $this->dbQuery($query, array($id));
    }
    
    /**
     * deleteRamassageParOffre()
     * Suppression des ramassages d'une offre dans la BDD
     */
    public function deleteRamassageParOffre($id)
    {
        $query = "DELETE FROM ramassagesparoffre WHERE idOffre = ?";
        $this->dbQuery($query, array($id));
    }
    
    /**
     * insertRamassage()
     * Insertion des ramassages d'une offre dans la BDD
     */
    public function insertRamassage($ramassage)
    {
        $query = "INSERT INTO ramassage (ville) VALUES (?)";
        $this->dbQuery($query, array($ramassage));
    }
    
    /**
     * insertRamassage()
     * Insertion d'une offre dans la BDD
     */
    public function insertOffre($jour, $date, $heure, $adresseDepart, $adresseArrivee, $depart, $retour)
    {
        $query = "INSERT INTO offre ("
                . "idUser, jour, date, heure, adresseDepart, codePostalDepart, villeDepart, "
                . "adresseArrivee, codePostalArrivee, villeArrivee) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $this->dbQuery($query, array(
            $_SESSION['uid'], $jour, $date, $heure, $adresseDepart, 
            $depart[0], $depart[1], $adresseArrivee, $retour[0], $retour[1])
        );
        
        $query3 = "SELECT MAX(o.id) FROM offre o";
        $result = $this->dbQuery($query3)->fetch();

        return $result;
    }
    
    /**
     * listRamassages()
     * Affiche les ramassages d'une offre
     */
    public function listRamassages($nb)
    {
        $query = "SELECT id FROM ramassage ORDER BY id DESC LIMIT " . $nb;
        $result = $this->dbQuery($query)->fetchAll();
        
        return $result;
    }
    
    /**
     * insertRamassageOffre()
     * Ajoute les ramassages d'une offre dans la BDD
     */
    public function insertRamassageOffre($a, $b)
    {
        $query = "INSERT INTO ramassagesparoffre(idOffre, idRamassage) VALUES (?, ?)";
        $this->dbQuery($query, array($a, $b));
    }
}

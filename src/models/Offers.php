<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Offers
 *
 * @author rozan_000
 */
class OffersModel extends Model {
    
    public function listOffres($depart, $arrivee)
    {
        $query = "SELECT * FROM offre WHERE villeDepart = ? OR villeArrivee = ?";
        $result = $this->dbQuery($query, array($depart, $arrivee))->fetchAll();
        
        return $result;
    }
    
    public function listMesOffres()
    {
        $query = "SELECT * FROM offre WHERE idUser = ?";
        $result = $this->dbQuery($query, array($_SESSION["uid"]))->fetchAll();

        return $result;
    }
    
    public function listDetailOffre($id)
    {
        $query = "
            SELECT * 
            FROM user u, offre o, ramassagesparoffre ro, ramassage r 
            WHERE o.idUser = u.id AND ro.idOffre = o.id AND ro.idRamassage = r.id AND o.id = ?
        ";
        
        $result = $this->dbQuery($query, array($id))->fetchAll();
        
        return $result;
    }
    
    public function listPassagerOffre($id)
    {
        $query = "
            SELECT p.nom, p.prenom, p.adresse, p.ville, p.email, p.tel 
            FROM offre o, passagersparoffre po, passager p 
            WHERE po.idOffre = o.id AND po.idPassager = p.id AND o.id = ?
        ";
        
        $result = $this->dbQuery($query, array($id))->fetchAll();
        
        return $result;
    }
    
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
    
    public function listMesOffresAModifier($id)
    {
        $query = "SELECT * FROM offre WHERE id = ?";
        $result = $this->dbQuery($query, array($id))->fetch();
        
        return $result;
    }
    
    public function updateOffre($jour, $date, $heure, $depart, $arrivee, $id)
    {
        $query = "UPDATE offre SET jour=?, date=?, heure=?, villeDepart=?, villeArrivee=? WHERE id=?";
        $this->dbQuery($query, array($jour, $date, $heure, $depart, $arrivee, $id));
    }
    
    public function deleteOffre($id)
    {
        $query = "DELETE FROM offre WHERE id = ?";
        $this->dbQuery($query, array($id));
    }
    
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
    
    public function deleteRamassage($id)
    {
        $query = "DELETE FROM ramassage WHERE id = ?";
        $this->dbQuery($query, array($id));
    }
    
    public function deleteRamassageParOffre($id)
    {
        $query = "DELETE FROM ramassagesparoffre WHERE idOffre = ?";
        $this->dbQuery($query, array($id));
    }
    
    public function insertRamassage($ramassage)
    {
        $query = "INSERT INTO ramassage (ville) VALUES (?)";
        $this->dbQuery($query, array($ramassage));
    }
    
    public function insertOffre($jour, $date, $heure, $depart, $retour)
    {
        $query = "INSERT INTO offre (idUser, jour, date, heure, villeDepart, villeArrivee) VALUES (?, ?, ?, ?, ?, ?)";
        $this->dbQuery($query, array($_SESSION['uid'], $jour, $date, $heure, $depart, $retour));
        
        $query3 = "SELECT MAX(o.id) FROM offre o";
        $result = $this->dbQuery($query3)->fetch();

        return $result;
    }
    
    public function listRamassages($nb)
    {
        $query = "SELECT id FROM ramassage ORDER BY id DESC LIMIT " . $nb;
        $result = $this->dbQuery($query)->fetchAll();
        
        return $result;
    }
    
    public function insertRamassageOffre($a, $b)
    {
        $query = "INSERT INTO ramassagesparoffre(idOffre, idRamassage) VALUES (?, ?)";
        $this->dbQuery($query, array($a, $b));
    }
}

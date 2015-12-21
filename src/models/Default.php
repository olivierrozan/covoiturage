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
class DefaultModel extends Model {
    
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
        //$query = "SELECT * FROM offre WHERE idUser = ?";
        $query = "
            SELECT * 
            FROM user u, offre o, ramassagesparoffre ro, ramassage r 
            WHERE o.idUser = u.id AND o.idRamassageOffre = ro.idOffre AND ro.idRamassage = r.id AND o.id = ?
        ";
        
        $result = $this->dbQuery($query, array($id))->fetchAll();
        
        return $result;
    }
    
    public function listPassagerOffre($id)
    {
        //$query = "SELECT * FROM offre WHERE idUser = ?";
        $query = "
            SELECT * 
            FROM offre o, passagersparoffre ro, passager r 
            WHERE o.idPassagerOffre = ro.idOffre AND ro.idUser = r.id AND o.id = ?
        ";
        
        $result = $this->dbQuery($query, array($id))->fetchAll();
        
        return $result;
    }
    
    public function listPassagerRamassage($id)
    {
        //$query = "SELECT * FROM offre WHERE idUser = ?";
        $query = "
            SELECT * 
            FROM ramassage o, passagersparoffre ro, passager r 
            WHERE o.idPassagerOffre = ro.idOffre AND ro.idUser = r.id AND o.id = ?
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
    
    public function insertOffre($jour, $date, $heure, $depart, $retour)
    {
        $query = "INSERT INTO offre (idUser, jour, date, heure, villeDepart, villeArrivee) VALUES (?, ?, ?, ?, ?, ?)";
        $this->dbQuery($query, array($_SESSION['uid'], $jour, $date, $heure, $depart, $retour));
    }
}

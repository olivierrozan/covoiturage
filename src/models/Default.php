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
    
    public function listOffresArrivee()
    {
        $query = "SELECT * FROM offresarriveeentreprise";
        $result = $this->dbQuery($query)->fetchAll();
        
        return $result;
    }
    
    public function listOffresDepart()
    {
        $query = "SELECT * FROM offresdepartentreprise";
        $result = $this->dbQuery($query)->fetchAll();
        
        return $result;
    }
    
    public function listMesOffresArrivee()
    {
        $query = "SELECT * FROM offresarriveeentreprise WHERE iduser = ?";
        $result = $this->dbQuery($query, array($_SESSION["uid"]))->fetchAll();

        return $result;
    }
    
    public function listMesOffresDepart()
    {
        $query = "SELECT * FROM offresdepartentreprise WHERE iduser = ?";
        $result = $this->dbQuery($query, array($_SESSION["uid"]))->fetchAll();
        
        return $result;
    }
    
    public function listMesOffresDepartAModifier($id)
    {
        $query = "SELECT * FROM offresdepartentreprise WHERE id = ?";
        $result = $this->dbQuery($query, array($id))->fetch();
        
        return $result;
    }
    
    public function listMesOffresArriveeAModifier($id)
    {
        $query = "SELECT * FROM offresarriveeentreprise WHERE id = ?";
        $result = $this->dbQuery($query, array($id))->fetch();
        
        return $result;
    }
    
    public function updateOffreDepart($jour, $date, $heure, $retour)
    {
        $query = "UPDATE offresdepartentreprise SET jour=?, date=?, heure=?, retour=? WHERE id=?";
        $this->dbQuery($query, array($jour, $date, $heure, $retour, $_GET['id']));
    }
    
    public function updateOffreArrivee($jour, $date, $heure, $depart)
    {
        $query = "UPDATE offresarriveeentreprise SET jour=?, date=?, heure=?, depart=? WHERE id=?";
        $this->dbQuery($query, array($jour, $date, $heure, $depart, $_GET['id']));
    }
    
    public function deleteOffre($table, $id)
    {
        $query = "DELETE FROM " . $table . " WHERE id = ?";
        $this->dbQuery($query, array($id));
    }
    
    public function insertOffreDepart($type, $jour, $date, $heure, $retour)
    {
        $adresse = $type === "offresdepartentreprise" ? "retour" : "depart";
        $query = "INSERT INTO " . $type . " (iduser, jour, date, heure, " . $adresse . ") VALUES (?, ?, ?, ?, ?)";
        $this->dbQuery($query, array($_SESSION['uid'], $jour, $date, $heure, $retour));
    }
}

<?php
/**
 * Description of Offers
 *
 * @author rozan_000
 */
class ProfilModel extends Model {
    
    /*public function updateProfil($id, $email, $nom, $prenom, $tel)
    {        
        $query = "UPDATE user SET email=?, nom=?, prenom=?, tel=? WHERE id=?";
        $this->dbQuery($query, array($email, $nom, $prenom, $tel, $id));
    }*/
    
    /**
     * updateProfil()
     * Modifie la profil dans la BDD
     */
    public function updateProfil($id, $infos)
    {        
        $query = "UPDATE user SET email=?, nom=?, prenom=?, adresse=?, codePostal=?, ville=?, tel=?, voiture=?, places=? WHERE id=?";
        $this->dbQuery($query, array(
            $infos["email"], 
            $infos["nom"], 
            $infos["prenom"], 
            $infos["adresse"], 
            $infos["codePostal"], 
            $infos["ville"], 
            $infos["tel"], 
            $infos["voiture"], 
            $infos["places"], 
            $id
        ));
    }
    
    /**
     * updateProfil()
     * Modifie le mot de passe dans la BDD
     */
    public function updatePassword($id, $infos)
    {
        $hashPassword = password_hash($infos["password"], PASSWORD_BCRYPT, ['cost' => 10]);
        
        $query = "UPDATE user SET password=? WHERE id=?";
        
        $this->dbQuery($query, array($hashPassword, $id));
    }
}

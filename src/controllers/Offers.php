<?php
/**
 * Description of Offers
 *
 * @author rozan_000
 */

require_once($rootPath . 'models/User.php');
require_once($rootPath . 'models/Offers.php');

class OffersController extends Controller {
    protected $template = "";
    protected $title = "";
    protected $data = array(), $data2 = array(), $data3 = array();
    protected $dates = array();
    
    public function indexAction() 
    {
        $this->title = "Recherche";
        
        $this->template = "views/index.html.php";
    }

    public function offresAction() 
    {
        $this->title = "Offres";
        
        $offers = new OffersModel();
        
        if (isset($_POST["villeDepart"]) && isset($_POST["villeArrivee"])) {
            $this->data2 = explode(", ", htmlspecialchars($_POST["villeDepart"]));
            $this->data3 = explode(", ", htmlspecialchars($_POST["villeArrivee"]));
            
            $_SESSION["depart"] = htmlspecialchars($_POST["villeDepart"]);
            $_SESSION["arrivee"] = htmlspecialchars($_POST["villeArrivee"]);
        } else {
            $this->data2 = explode(", ", htmlspecialchars($_GET["depart"]));
            $this->data3 = explode(", ", htmlspecialchars($_GET["arrivee"]));
            
            $_SESSION["depart"] = htmlspecialchars($_GET["depart"]);
            $_SESSION["arrivee"] = htmlspecialchars($_GET["arrivee"]);
        }
        
        $this->data = $offers->listOffres($this->data2[0], $this->data3[0]);
        
        foreach ($this->data as $d) {
            $a = $d['date'] !== NULL ? "Le " . utf8_encode(strftime("%d %B %Y", strtotime($d['date']))) : "Tous les " . $d['jour'];
            array_push($this->dates, $a);
        }
                
        $this->template = "views/offers.html.php";
    }
    
    public function mesoffresAction() 
    {
        unset($_SESSION['depart']);
        unset($_SESSION['arrivee']);
        
        $user = new UserModel();
        
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new OffersModel();
        
        $this->data = $offers->listMesOffres();
        
        foreach ($this->data as $d) {
            $a = $d['date'] !== NULL ? "Le " . utf8_encode(strftime("%d %B %Y", strtotime($d['date']))) : "Tous les " . $d['jour'];
            array_push($this->dates, $a);
        }
        
        $this->title = "Offres de " . $_SESSION["login"];
        
        $this->template = "views/mesoffres.html.php";
    }
    
    public function detailsoffreAction()
    {   
        $offers = new OffersModel();
        
        $id = htmlspecialchars($_GET['id']);
        $this->data = $offers->listDetailOffre($id);
        $this->data2 = $offers->listPassagerOffre($id);
        $this->data3 = $offers->listPassagerRamassage($id);
        
        $a = $this->data[0]['date'] !== NULL ? "Le " . 
                utf8_encode(strftime("%d %B %Y", strtotime($this->data[0]['date']))) : "Tous les " . 
                $this->data[0]['jour'];
        array_push($this->dates, $a);
        
        $this->title = "Details Offre : ";
        $this->template = "views/detailoffre.html.php";
    }
    
    public function deleteoffreAction()
    {
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new OffersModel();
        
        $id = htmlspecialchars($_GET["id"]);
        
        $this->data = $offers->listRamassageParOffre($id);
        
        for ($i = 0; $i < count($this->data); $i++) {
            $offers->deleteRamassage($this->data[$i]['idRam']);
        }
        
        $offers->deleteOffre($id);
        $offers->deleteRamassageParOffre($id);
        
        header("Location: ?controller=offers&action=mesoffres");
        
        $this->template = "views/mesoffres.html.php";
    }
    
    public function modifieroffreformAction()
    {
        $this->title = "Modifier Offre";
        
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $offers = new OffersModel();
        
        $id = htmlspecialchars($_GET["id"]);
        $this->data = $offers->listMesOffresAModifier($id);
        
        $this->template = "views/modifieroffre.html.php";
    }
    
    public function updateoffreAction()
    {
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $default = new OffersModel();
        
        $jour = htmlspecialchars($_POST['jour']);
        $date = htmlspecialchars($_POST['date']);
        $heure = htmlspecialchars($_POST['heure']);
        $depart = htmlspecialchars($_POST['depart']);
        $arrivee = htmlspecialchars($_POST['arrivee']);
        $id = htmlspecialchars($_GET["id"]);
        
        $default->updateOffre($jour, $date, $heure, $depart, $arrivee, $id);
        
        header("Location: ?controller=offers&action=mesoffres");
        
        $this->template = "views/modifieroffres.html.php";
    }
    
    public function ajouteroffreAction()
    {
        $this->title = "Ajouter Offre";
        
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $this->template = "views/ajouteroffre.html.php";
    }
    
    public function insertoffreAction()
    {
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $default = new OffersModel();

        $periode = htmlspecialchars($_POST['periode']);
        
        if ($periode === 'permanente') {
            $jour = htmlspecialchars($_POST["jour"]);
            $date = NULL;
        } else {
            $jour = "";
            $date = htmlspecialchars($_POST["date"]);
        }
        
        $depart = htmlspecialchars($_POST["depart"]);
        $arrivee = htmlspecialchars($_POST["arrivee"]);
        $heure = htmlspecialchars($_POST["heure"]) . "h" . htmlspecialchars($_POST["minute"]);
                
        $listId = $default->insertOffre($jour, $date, $heure, $depart, $arrivee);
        
        $this->addRamassage($listId);
        
        header("Location: ?controller=offers&action=mesoffres");
        
        $this->template = "views/mesoffres.html.php";
    }
    
    private function addRamassage($listId)
    {
        $default = new OffersModel();
        
        if (isset($_POST['ramassage'])) {
            $ramassage = htmlspecialchars($_POST['ramassage']);
        }
        
        foreach($ramassage as $field) {
            $default->insertRamassage($field);
        }

        $a = $default->listRamassages(count($ramassage));

        for ($i = 0; $i < count($a); $i++) {
            $default->insertRamassageOffre($listId[0], $a[$i][0]);
        }
    }
    
    public function insertramassageAction()
    {
        $user = new UserModel();
        if (!$user->isAuth()) {
            header("Location: ?controller=user&action=login");
        }
        
        $default = new OffersModel();
        
        if (isset($_POST['ramassage'])) {
            $this->data = $_POST['ramassage'];
        } 
        
        foreach($this->data as $field) {
            $default->insertRamassage($field);
        }
        
        $id = htmlspecialchars($_GET['id']);
        $a = $default->listRamassages(count($this->data));

        for ($i = 0; $i < count($a); $i++) {
            $default->insertRamassageOffre($id, $a[$i][0]);
        }
        
        header("Location: ?controller=offers&action=mesoffres");
        
        $this->template = "views/mesoffres.html.php";
    }
    
    public function render()
    {
        ob_start();
        
        $title = $this->title;
        $data = $this->data;
        $data2 = $this->data2;
        $data3 = $this->data3;
        $dates = $this->dates;
        
        include($this->rootPath . $this->template);
        
        return ob_get_clean();
    }
}

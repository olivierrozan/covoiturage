<?php
/**
 * Description of Model
 *
 * @author rozan_000
 */
class Model {
    private $dbName;
    private $lastResult;
    
    public function __construct() 
    {
        
    }
    
    /**
     * connect()
     * Connexion à la BDD
     */
    protected function connect()
    {
        global $config;
        
        if (empty($this->db)) {
            $this->db = new PDO("mysql:host=" . $config["db_host"] . ";dbname=" . $config["db_name"], $config["db_login"], $config["db_password"]);
            $this->db->query("SET NAMES UTF8");
            setlocale(LC_TIME, 'fra_fra');
        }
    }
    
    /**
     * dbQuery()
     * Gestion des requêtes SQL
     */
    protected function dbQuery($query, $data = array())
    {
        $this->connect();
        
        $q = $this->db->prepare($query);
        $this->lastResult = $q->execute($data);
        
        return $q;
    }
    
    /**
     * listAll()
     * Liste la totalité d'une table de la BDD
     */
    public function listAll($table)
    {
        $query = "SELECT * FROM " . $table;
        
        return $this->dbQuery($query)->fetchAll();
    }
    
    /**
     * create()
     * Insertion de champs dans la BDD
     */
    public function create($data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        
        $filler = array_pad(array(), count($data), "?");
        $queryFields = "(" . implode(",", $filler) . ")";
        
        $query = "INSERT INTO " . $this->table . " " . $queryFields . " VALUES " . $queryFields;
        $queryData = array_merge($keys, $values);
        var_dump($query);
        var_dump($queryData);
        
        return $this->dbQuery($query, $queryData);
    }
}

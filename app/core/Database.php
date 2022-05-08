<?php 

class Database {

    private $host = HOST;
    private $user = USER;
    private $pass = PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;

    public function __construct() {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            // die($e->getMessage());
            if( isset($e) ){
                $error = $e->getMessage();
                $error = explode("'", $error);
                foreach ($error as $key => $value) {
                    if( $value == "SQLSTATE[HY000] [1049] Unknown database " ){
                        $dsn = 'mysql:host=' . $this->host . ';';
                        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
                        $this->dbh->exec("CREATE DATABASE " . $this->dbname);
                        print "[Kasiran] Database " . $this->dbname . " has been created\n";
                    }
                }
            }
        }
    }

    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        return $this->stmt->execute();
    }

    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }

    public function getField($field) {
        $this->execute();
        return $this->stmt->fetchColumn($field);
    }

}
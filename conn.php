<?php 
class Connection {
    private $db_name = DB_NAME;
    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_pswd = DB_PSWD;
    private $db_dsn;
    private $db_options;

    public function __construct() {
        $this->db_dsn  = 'mysql:dbname='.$this->db_name.'; host='.$this->db_host.'; charset=utf8';
        $this->db_options = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
        ];
    }
    public function database() {
        try {
            $connection = new PDO($this->db_dsn, $this->db_user, $this->db_pswd, $this->db_options);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } 
        catch(PDOException $e) {
            die('<strong>Falha na comunicação com o banco de dados:</strong>');
            error_log('Falha na comunicação com o banco de dados:: ( '.$e->getMessage().' )');
        }
    }
}

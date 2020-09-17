<?php

namespace Core\Database;

use mysqli;

class Database {

    private $servername = 'localhost';
    private $username = 'root';
    private $password = '6993';
    public $mySQL;

    public function __construct(string $DB_name, string $table_name)
    {
        $this->mySQL = new mysqli($this->servername, $this->username, $this->password, $DB_name);

        if ($this->mySQL->connect_error) {
            die("Connection failed: " . $this->mySQL->connect_error);
        } else {
            $this->tableExists($table_name);
        }
    }

    /**
     * Check if table index exists
     * @param string $table_name
     * @return bool
     */
    private function tableExists(string $table_name): void
    {
        if (!$this->mySQL->query("DESCRIBE `$table_name`")){

            $this->mySQL->query("CREATE TABLE $table_name (
                user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(30) NOT NULL,
                name VARCHAR(30) NOT NULL,
                last_name VARCHAR(30) NOT NULL,
                phone VARCHAR(12) NOT NULL,
                password VARCHAR(60) NOT NULL,
                registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                last_login_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
                )");
        }
    }
}

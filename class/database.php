<?php

namespace App;

use mysqli;

class Database
{
    private string $servername = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $dbname = "writer's corner";

    public mysqli $con;
    public function __construct()
    {
        $this->con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
    }
    public function check()
    {
        if ($this->con) {
            echo "Successfully connected to the database.";
        } else {
            echo "Failed to connect to the database.";
        }
    }
    public function closeConnection()
    {
        mysqli_close($this->con);
    }
}
?>
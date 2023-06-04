<?php

class DbConnection
{
    public $db;

    public function getConnection()
    {
        $this->db = null;

        try {
            $this->db = new mysqli('localhost', 'root', '', 'mergy_task');
        } catch (Exception $e) {
            echo "error" . $e->getMessage();
        }
        return $this->db;
    }
  
    
}
?>
<?php
class User
{
    private $db;

    private $db_table = "users";

    public $id;
    public $name;
    public $email;
    public $job;
    public $cv;
    public $user_image;
    public $experience;
    public $job_title;
    public $job_location;
    public $start_date;
    public $end_date;
    public $result;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUsers()
    {
        $stmt = "SELECT id, name, email, job, cv, user_image FROM " . $this->db_table;
        $this->result = $this->db->query($stmt);
        return $this->result;
    }

    public function createUser()
    {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->job = htmlspecialchars(strip_tags($this->job));
        $this->cv = stripslashes($this->cv);
        $this->user_image = stripslashes($this->user_image);

        $stmt = "INSERT INTO " . $this->db_table .
            " SET name= '" . $this->name . "',
            email= '" . $this->email . "',
            job= '" . $this->job . "',
            cv= '" . $this->cv . "',
            user_image= '" . $this->user_image . "'";

        $this->db->query($stmt);

        if ($this->db->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getSingleUser()
    {
        $stmt = "SELECT id, name, email, job, cv, user_image 
        FROM " . $this->db_table . " 
        WHERE id = '" . $this->id . "'";


        $record  = $this->db->query($stmt);
        if ($record === false) {
            echo "error query" . $this->db->error;
            return;
        }
        $dataRow = $record->fetch_assoc();
        $this->name = $dataRow['name'];
        $this->email = $dataRow['email'];
        $this->job = $dataRow['job'];
        $this->cv = $dataRow['cv'];
        $this->user_image = $dataRow['user_image'];
    }

    public function updateUser()
    {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->job = htmlspecialchars(strip_tags($this->job));
        $this->cv = htmlspecialchars(strip_tags($this->cv));
        $this->user_image = htmlspecialchars(strip_tags($this->user_image));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt = "UPDATE " . $this->db_table .
            " SET name = '" . $this->name . "',
        email = '" . $this->email . "',
        job = '" . $this->job . "',
        cv = '" . $this->cv . "',
        user_image = '" . $this->user_image . "'
        WHERE id = '" . $this->id . "'";

        $this->db->query($stmt);
        if ($this->db->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }



    public function deleteUser()
    {
        $stmt = "DELETE FROM " . $this->db_table . " WHERE id = '" . $this->id . "'";
        $this->db->query($stmt);

        if ($this->db->affected_rows > 0) {
            return true;
        } else {

            return false;
        }
    }
}

<?php
class client {

    function __construct($db) {
        $this->db = $db;
    }

    function get($name) {
        try {
            $sql = "SELECT * FROM users WHERE username='".$name."'";
            $stm = $this->db->prepare($sql);
            $stm->execute(array($name));
            return $stm->fetchAll()[0];
        } catch (PDOException $pdoe) {
            echo "<br>Could not fetch user ".$name."<br>".$pdoe->getMessage();
        }
    }

    function add($name, $hashed_password) {
        try {
            $sql = "INSERT INTO users (username,password) VALUES(\"".$name."\",\"".$hashed_password."\");";
            $this->db->exec($sql);
        } catch (PDOException $pdoe) {
            echo "<br>Could not add new user.<br>" . $pdoe->getMessage();
        }
    }
}
?>

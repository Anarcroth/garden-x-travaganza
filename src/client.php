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
            echo "Could not fetch user ".$name;
        }
    }
}
?>

<?php
class catalogue {

    function __construct($db) {
        $this->db = $db;
    }

    function getAll() {
        try {
            $sql = "SELECT * FROM catalogue";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (PDOException $pdoe) {
            echo "<br>Could not fetch all items<br>".$pdoe->getMessage();
        }
    }

    function getItemByName($name) {
        try {
            $sql = "SELECT * FROM catalogue WHERE item='".$name."'";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (PDOException $pdoe) {
            echo "<br>Could not fetch item ".$name."<br>".$pdoe->getMessage();
        }
    }

    function getItemByCode($code) {

    }
}
?>

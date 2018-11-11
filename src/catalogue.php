<?php
class catalogue {

    function __construct($db) {
        $this->db = $db;
    }

    function getAll() {
        try {
            $sql = "SELECT * FROM catalogue";
            return $this->exec($sql);
        } catch (PDOException $pdoe) {
            echo "<br>Could not fetch all items<br>".$pdoe->getMessage();
        }
    }

    function getItemByName($name) {
        try {
            $sql = "SELECT * FROM catalogue WHERE item='".$name."'";
            return $this->exec($sql);
        } catch (PDOException $pdoe) {
            echo "<br>Could not fetch item ".$name."<br>".$pdoe->getMessage();
        }
    }

    function getItemByCode($id) {
        try {
            $sql = "SELECT * FROM catalogue WHERE id='".$id."'";
            return $this->exec($sql);
        } catch (PDOException $pdoe) {
            echo "<br>Could not fetch item ".$id."<br>".$pdoe->getMessage();
        }
    }

    function getSetOf($setOfItems) {
        try {
            $sql = "SELECT * FROM catalogue WHERE item IN ('".implode("','", $setOfItems)."')";
            return $this->exec($sql);
        } catch (PDOException $pdoe) {
            echo "<br>Could not fetch item ".$id."<br>".$pdoe->getMessage();
        }
    }

    function exec($sql) {
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }
}
?>

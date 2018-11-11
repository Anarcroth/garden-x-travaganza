<?php
class catalogue {

    function __construct($db) {
        $this->db = $db;
    }

    function getAll() {
        $sql = "SELECT * FROM catalogue";
        return $this->exec($sql);
    }

    function getItemByName($name) {
        $sql = "SELECT * FROM catalogue WHERE item='".$name."'";
        return $this->exec($sql);
    }

    function getItemByCode($id) {
        $sql = "SELECT * FROM catalogue WHERE id='".$id."'";
        return $this->exec($sql);
    }

    function getSetOf($setOfItems) {
        $sql = "SELECT * FROM catalogue WHERE item IN ('".implode("','", $setOfItems)."')";
        return $this->exec($sql);
    }

    function getRandomItems() {
        // For simplicity, 6 is the set limit
        $sql = "SELECT * FROM catalogue ORDER BY RAND() LIMIT 6";
        return $this->exec($sql);
    }

    function exec($sql) {
        try {
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (PDOException $pdoe) {
            echo "<br>Could not fetch item ".$id."<br>".$pdoe->getMessage();
        }
    }
}
?>

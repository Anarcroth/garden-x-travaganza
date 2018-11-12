<?php
class promo {

    function __construct($db) {
        $this->db = $db;
    }

    function getAll() {
        $sql = "SELECT * FROM promo";
        return $this->exec($sql);
    }

    function getItemByCode($code) {
        $sql = "SELECT * FROM promo WHERE code='".$code."'";
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

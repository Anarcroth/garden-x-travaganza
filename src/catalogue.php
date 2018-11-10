<?php
class catalogue {

    function __construct($db) {
        $this->db = $db;
    }

    function getAll() {
        $sql = "SELECT * FROM catalogue";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    function getItemByName($name) {
        $sql = "SELECT * FROM catalogue WHERE item='".$name."'";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    function getItemByCode($code) {

    }
}
?>

<?php

require_once 'model/AbstractDB.php';

class NarociloDB extends AbstractDB {

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT * "
                        . "          CONCAT(:prefix, idnarocilo) as uri "
                        . "FROM narocilo "
                        . "ORDER BY idnarocilo ASC", $prefix);
    }
    
   public static function getAll() {
        return parent::query("SELECT *"
                        . " FROM narocilo"
                        . " ORDER BY idnarocilo ASC");
    }
    
    public static function get(array $id) {
        $x = $id["id"];
        $narocila =  parent::query("SELECT *"
                        . " FROM narocilo"
                        . " WHERE stranka_idstranka = $x");
        
         if (count($narocila) > 0) {
            return $narocila;
        } else {
            throw new InvalidArgumentException("Narocilo ne obstaja!");
        }
    }
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO narocilo (cena, stranka_idstranka, potrjeno, preklicano) "
                        . " VALUES (:cena, :stranka_idstranka, :potrjeno, :preklicano)", $params);
    }
    
    public static function update(array $params) {
        return parent::modify("UPDATE narocilo SET"
                        . " potrjeno = :potrjeno, preklicano = :preklicano"
                        . " WHERE idnarocilo = :id", $params);
    }

    public static function delete(array $id) {
        $x = $id["id"];
        return parent::modify("DELETE FROM narocilo WHERE idnarocilo = :id",$id);
    }
    
    
}


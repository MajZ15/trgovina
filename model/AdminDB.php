<?php
class AdminDB extends AbstractDB {
    
     public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT idadmin, ime, priimek, email"
                        . "          CONCAT(:prefix, idadmin) as uri "
                        . "FROM admin "
                        . "ORDER BY idadmin ASC", $prefix);
    }
    
   public static function getAll() {
        return parent::query("SELECT idadmin, ime, priimek, email"
                        . " FROM admin"
                        . " ORDER BY idadmin ASC");
    }
    
    public static function get(array $id) {
        $x = $id["id"];
        $stranke =  parent::query("SELECT idadmin, ime, priimek, email"
                        . " FROM admin"
                        . " WHERE  idadmin = $x");
        
         if (count($stranke) == 1) {
            return $stranke[0];
        } else {
            throw new InvalidArgumentException("Admin ne obstaja!");
        }
    }
    
    public static function insert(array $params) {
        $params["geslo"] = password_hash($params["geslo"], PASSWORD_BCRYPT);
        return parent::modify("INSERT INTO admin (ime, priimek, email, geslo) "
                        . " VALUES (:ime, :priimek, :email, :geslo)", $params);
    }
    
    public static function update(array $params) {
        $params["geslo"] = password_hash($params["geslo"], PASSWORD_BCRYPT);
        return parent::modify("UPDATE admin SET ime = :ime, priimek = :priimek, "
                        . "email = :email, geslo = :geslo"
                        . " WHERE idadmin = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM admin WHERE idadmin = :id",$id);
    }
    
    
    
    
    
    
}
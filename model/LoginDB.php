<?php
class LoginDB extends AbstractDB {
    public static function get(array $params) {
        $email = $params["email"];
        $password = $params["geslo"];

        $stranke =  parent::query("SELECT idstranka, ime, priimek, email, telefon, naslov, aktiviran"
                        . " FROM stranka"
                        . " WHERE  email = :email AND"
                        . " aktiviran = 1", $params);
        $prodajalci =  parent::query("SELECT idprodajalec, ime, priimek, email, aktiviran"
                        . " FROM prodajalec"
                        . " WHERE  email = :email AND"
                        . " aktiviran = 1", $params);
        $admini =  parent::query("SELECT idadmin, ime, priimek, email"
                        . " FROM admin"
                        . " WHERE  email = :email", $params);
         if (count($stranke) == 1) {
            $hash =  parent::query("SELECT geslo"
                        . " FROM stranka"
                        . " WHERE  email = :email", $params);
            if (password_verify($password, $hash[0]["geslo"])) {
                $stranke[0]["tip"] = 0;
                return $stranke[0];
            } else {
                throw new InvalidArgumentException("Napacno geslo!");
            }
        } else if (count($prodajalci) == 1)  {
            $hash =  parent::query("SELECT geslo"
                        . " FROM prodajalec"
                        . " WHERE  email = :email", $params);
            if (password_verify($password, $hash[0]["geslo"])) {
                $prodajalci[0]["tip"] = 1;
                return $prodajalci[0];
            } else {
                throw new InvalidArgumentException("Napacno geslo!");
            }
        } else if (count($admini) == 1) {
            $hash =  parent::query("SELECT geslo"
                        . " FROM admin"
                        . " WHERE  email = :email", $params);
            if (password_verify($password, $hash[0]["geslo"])) {
                $admini[0]["tip"] = 2;
                return $admini[0];
            } else {
                throw new InvalidArgumentException("Napacno geslo!");
            }
        }
        else {
            throw new InvalidArgumentException("Uporabnik ne obstaja!");
        }
    }

    public static function getAll() {
        throw new Exception();
    }

    public static function insert(array $params) {
        throw new Exception();
    }

    public static function update(array $params){
        throw new Exception();
    }

    public static function delete(array $id) {
        throw new Exception();
    }
}

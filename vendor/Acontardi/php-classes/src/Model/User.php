<?php

namespace Acontardi\Model;

use Acontardi\DB\Sql;
use Acontardi\Model;

class User extends Model {

    const SESSION = "User";

    public static function login($deslogin, $despassword)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
            ":LOGIN"=>$deslogin
        ));
        
        if (count($results) === 0)
        {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }

        $data = $results[0];
        
        /* Codigo para verificar senha criptografada
        if (password_verify($despassword, $data["despassword"]) === true)
        {
            $user = new User();
            $user->setData($data);
            $_SESSION[User::SESSION] = $user->getValeus();

            return $user;

        }else {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }
        */
    }

    public static function verifyLogin($inadmin = true)
    {
        if (
            !isset($_SESSION[User::SESSION])
            || 
            !$_SESSION[User::SESSION]
            ||
            (int)$_SESSION[User::SESSION]["inadmin"] > 0
            ||
            (bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin
            ) {
                header("Location: /admin/login");
                exit;
        }
    }

    public static function logout()
    {
        $_SESSION[User::SESSION] == null;
    }
}

?>
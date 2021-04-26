<?php

namespace App\Clases;

use PhpParser\Builder\Class_;

class Utilitat
{
   public static function errorMessage($exception)
{
    if (!empty($exception->errorInfo[1])) {
        switch ($exception->errorInfo[1]) {
            case 1048:
                $message = "No s'ha pogut actualitzar. Siusplau ompli tots els camps obligatoris. ";
                break;
            case 1062:
                $message = "Registre duplicat";
                break;
            case 1264:
                $message = "Input fora de rang";
                break;
            case 1451;
                $message = "Registre amb elements relacionats.";
                break;
            default:
                $message = $exception->errorInfo[1] . '-' . $exception->errorInfo[2];
                break;
        }
    }else {
        switch ($exception->getCode()) {
            case 1044:
                $message = "Informació incorrecta";
                break;
            case 1049:
                $message = "Base de dades desconeguda";
                break;
            case 2002:
                $message = "No s'ha pogut trobar el servidor";
                break;
            default:
                $message = $exception->getCode() . '-' . $exception->getMessage();
                break;
        }
    }

    return $message;
}

}

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
                $message = "No se ha podido actualizar, por favor rellene todos los campos. ";
                break;
            case 1062:
                $message = "Registro duplicado";
                break;
            case 1451;
                $message = "Registro con elementos relacionados.";
                break;
            default:
                $message = $exception->errorInfo[1] . '-' . $exception->errorInfo[2];
                break;
        }
    }else {
        switch ($exception->getCode()) {
            case 1044:
                $message = "Incorrect information";
                break;
            case 1049:
                $message = "Unknown database";
                break;
            case 2002:
                $message = "Could not find the server";
                break;
            default:
                $message = $exception->getCode() . '-' . $exception->getMessage();
                break;
        }
    }

    return $message;
}

}

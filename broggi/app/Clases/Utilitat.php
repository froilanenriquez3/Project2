<?php

namespace App\Clases;

use PhpParser\Builder\Class_;

class Utilitat
{
   public static function errorMessage($exception)
{
    if (!empty($exception->errorInfo[1])) {
        switch ($exception->errorInfo[1]) {
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
    }
    return $message;
}

}

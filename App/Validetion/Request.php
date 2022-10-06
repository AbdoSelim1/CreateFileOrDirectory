<?php

namespace App\Validetion;

use App\Validetion\Rules;

session_start();
class Request extends Rules
{
    public static array $avilableType  = ['php', 'json','text'];

    public static function validFolder($field): bool
    {
        $massages = (new self)->required($field)->max($field)->getMassages();
        if (empty($massages)) {
            return true;
        } else {
            $_SESSION['errors']['folder'] = $massages;
            return false;
        }
    }

    public static function validFile(array $fields): bool
    {
        $massages = (new self)->required($fields['file_name'])
            ->required($fields['file_type'])
            ->in($fields['file_type'], self::$avilableType)
            ->max($fields['file_name'])
            ->max($fields['file_content'], 2000)
            ->max($fields['file_type'])
            ->getMassages();
        if (empty($massages)) {
            return true;
        } else {
            $_SESSION['errors']['file'] = $massages;
            return false;
        }
    }

 
}




<?php

namespace App\Http\Controllers;

use App\Media\Create;
use App\Validetion\OldValue;
use App\Validetion\Request;

class MediaController
{

    public static function store($request): array
    {
        if (isset($request['folder_name'])) {
            $validFolder =  Request::validFolder($request['folder_name']);
            if ($validFolder) {
                $response = Create::folder("Folders", $request['folder_name']);
                unset($_SESSION['errors']['folder']);
                return $response;
            }
        } else {
            $validFile = Request::validFile($request);
            if ($validFile) {
                $response = Create::file("Files", $request['file_name'] . "." . $request['file_type'], self::appand($request['file_type'], $request['file_content']));
                unset($_SESSION['errors']['file']);
                return $response;
            }
        }

        return [];
    }

    public static function  appand($extention, string $content): string
    {
        if ($extention == "php") {
            $content = "<?php " . $content . "?>";
        } elseif ($extention == "json") {
            $content = "[ {" . $content . "} ]";
        }

        return $content;
    }
}

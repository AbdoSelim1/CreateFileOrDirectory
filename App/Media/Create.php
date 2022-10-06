<?php

namespace App\Media;

class Create
{
    private static string $content = "";
    public static function folder(string $path, string $dirName): array
    {
        $response = [];
        if (!file_exists($path . "/" . $dirName)) {
            $status = mkdir($path . "/" . $dirName);
            if ($status) {
                $response['success']['status'] = true;
                $response['success']['massage'] = "The Directory Created Successfilly";
            }
        } else {
            $response['error']['status'] = false;
            $response['error']['massage'] = "The Directory is an Already Exist!";
        }


        return $response;
    }


    public static function file(string $path, string $fileNmae, string $content = ""): array
    {
        self::$content = $content;
        $response = [];
        if (!file_exists($path . "/" . $fileNmae)) {
            $status = file_put_contents($path . "/" . $fileNmae, self::$content);
            if ($status != false) {
                $response['success']['status'] = true;
                $response['success']['massage'] = "The File and File Content is Created Successfilly";
            }
        }else {
            $response['error']['status'] = false;
            $response['error']['massage'] = "The File is an Already Exist!";
        }

        return $response;
    }
}

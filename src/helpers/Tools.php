<?php

namespace App\Helpers;

use Rakit\Validation\ErrorBag;

class Tools
{
    public static function manageCUrl($params, $header, $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        if (count($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if (count($params)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function slashToBackSlash($string)
    {
        return str_replace("/", "\\", $string);
    }

    public static function translateErrors(ErrorBag $allErrors, $translation)
    {
        $messages = $allErrors->messages;
        foreach ($messages as $from => $valueArray) {
            foreach ($valueArray as $key => $value) {
                $value = strtolower($value);
                foreach ($translation as $k => $trans) {
                    if (strpos($value, $k) !== false) {
                        $value = str_replace($k, $trans, $value);
                        $messages[$from][$key] = $value;
                        break;
                    }
                }
            }
        }
        $allErrors->messages = $messages;
        return $allErrors;
    }

    public static function createSalt()
    {
        return password_hash(rand(100000000, 900000000), PASSWORD_DEFAULT);
    }

    public static function redirect($url, $code = 301)
    {
        header("location: " . $url, true, $code);
        exit();
    }

    public static function backSlashToSlash($string)
    {
        return str_replace("\\", "/", $string);
    }

    public static function uniteUrls($url)
    {
        $lastChar = substr($url, -1);
        if ($lastChar != "/"){
            $url .= "/";
        }
        return $url;
    }

    public static function checkUrlType($url)
    {
        if (strpos($url, DOMAIN) === false) {
            return self::uniteUrls($url);
        } else {
            $slug = explode(DOMAIN, $url);
            return self::uniteUrls($slug[1]);
        }
    }

    public static function setStatus($code, $text, $data)
    {
        header('Content-Type: application/json');
        // header('Content-Type: application/x-www-form-urlencoded');
        $jsonArray = array();
        $jsonArray['status'] = $code;
        $jsonArray['data'] = $data;
        $jsonArray['status_text'] = $text;
        echo json_encode($jsonArray);
        exit();
    }

    public static function getUrl()
    {
        return ORIGIN . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}

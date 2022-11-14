<?php

namespace App\Helpers;

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

    public static function throw404()
    {
        header('HTTP/1.1 404 Not Found');
        return self::setStatus(404, 'route not defined', []);
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
    }

    public static function getUrl()
    {
        return ORIGIN . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}

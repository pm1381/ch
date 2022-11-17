<?php
namespace App\Helpers;

class Arrays 
{
    public static function specialCols()
    {
        return 
        [
            'AVG', 'SUM', 'MAX', 'MIN', 'COUNT'
        ];
    }

    public static function errorView()
    {
        return[
            'required' => ':attribute الزامی است',
            'email' => 'فیلد :attribute پست الکترئنیکی معتبری نمیباشد',
            'min' => 'فیلد :attribute کمتر از حد مجاز است',
            'same' => 'فیلد :attribute با مقدار اصلی خود شباهت ندارند'
        ];
    }

    public static function fieldNameTranslations()
    {
        return [
            'name' => 'نام',
            'email' => 'ایمیل',
            'password' => 'رمزعبور',
            'confirmPass' => 'تایید رمزعبور'
        ];
    }
}
?>
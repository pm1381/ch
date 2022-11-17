<?php
namespace App\Interfaces;

interface Auth
{
    public function AuthCreate();
    public function AuthValidation(array $data);
}
?>
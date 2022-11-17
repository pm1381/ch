<?php
namespace App\Interfaces;

interface Auth
{
    public function AuthCreate(array $data);
    public function AuthValidation(array $data);
}
?>
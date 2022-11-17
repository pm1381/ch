<?php
namespace App\Classes;

use App\Helpers\Tools;
use App\Helpers\Arrays;
use Rakit\Validation\ErrorBag;
use Rakit\Validation\Validator;

class Validation {
    
    private array $data;
    private Validator $validator;
    private $validData;
    
    public function __construct($data,Validator $validator)
    {
        $this->data = $data;
        $this->validator = $validator;
    }

    public function makeValidation()
    {
        $v = $this->validator->make($this->data, [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password'
        ]);
        $v->validate();

        $this->validData = $v;
    }

    public function handleValidationError()
    {
        $validationResult['error'] = false;
        if ($this->validData->fails()) {
            $errors = Tools::translateErrors($this->validData->errors(), Arrays::fieldNameTranslations());
            $validationResult = [
                'error' => true,
                'grabResult' => $errors->all(),
                'count' => $errors->count(),
                'to array' => $errors->toArray(),
                'first of each' => $errors->firstOfAll()
            ];
        }
        return $validationResult;
    }
}
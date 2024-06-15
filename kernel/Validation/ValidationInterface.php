<?php


namespace App\Kernel\Validation;


interface ValidationInterface{
    public function validate( array $data, array $rules = []);
    public function errors();
}
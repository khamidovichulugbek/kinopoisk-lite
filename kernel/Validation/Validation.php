<?php


namespace App\Kernel\Validation;

use App\Kernel\Config\Config;
use App\Kernel\Database\Database;
use App\Kernel\Database\DatabaseInterface;

class Validation implements ValidationInterface
{

    private array $rules;
    private array $data;
    private array $errors = [];

    public function __construct()
    {
    }

    public function validate(array $data, array $rules = [])
    {
        $this->errors = [];
        $this->data = $data;

        foreach ($rules as $key => $rule) {
            $rules = $rule;

            foreach ($rules as $rule) {
                $rule = explode(":", $rule);
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                $errors = $this->validateRule($key, $ruleName, $ruleValue);
                if ($errors) {
                    $this->errors[$key][] = $errors;
                }
            }
        }
        return empty($this->errors);
    }

    private function validateRule($key, $ruleName, $ruleValue)
    {
        $name = $this->data[$key];

        switch ($ruleName) {
            case 'required':
                if (empty($name)) {
                    return "Ushbu $key sahifansini to'ldirish majburiy";
                }
                break;
            case 'min':
                if (strlen($name) < $ruleValue) {
                    return "Ushbu sahifa minimum $ruleValue ta joydan iborat bo'lishi kerak";
                }
                break;
            case 'max':
                if (strlen($name) > $ruleValue) {
                    return "Max len $ruleValue";
                }
                break;

            case 'email':
                if (!filter_var($name, FILTER_VALIDATE_EMAIL)) {
                    return "Iltimos $key ni to'g'ri kiriting";
                }
                break;
            case 'confirmation':
                if ($name !== $this->data["{$key}_confirmation"]) {
                    return "Parollar bir biriga mos emas !!";
                }
                break;
        }


        return false;
    }

    public function errors()
    {
        return $this->errors;
    }
}

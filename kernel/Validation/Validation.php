<?php


namespace App\Kernel\Validation;

class Validation implements ValidationInterface{

    private array $rules;
    private array $data;
    private array $errors = [];

    public function validate(array $data, array $rules = []){
        $this->data = $data;
        $this->rules = $rules;

        foreach($rules as $key => $rule){
            $rules = $rule;

            foreach ($rules as $rule){
                $rule = explode(":", $rule);
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                $errors = $this->validateRule($key, $ruleName, $ruleValue);
                if($errors) {
                    $this->errors[$key][] = $errors;
                }

                

            }
        }

        return empty($errors);
    

    }

    private function validateRule($key, $ruleName, $ruleValue){
        $name = $this->data[$key];

        switch($ruleName){
            case 'required':
                if (empty($name)) {
                    return "Required";
                }
                break;
            case 'min':
                if (strlen($name) < $ruleValue){
                    return "Min len $ruleValue";
                }
        }

        return false;
    }

    public function errors(){
        return $this->errors;
    }
}
<?php

namespace model;
require_once 'ValidInterface.php';
require_once 'Max20.php';
require_once 'MaxTweet.php';
require_once 'Min5.php';
require_once 'Numeric.php';
require_once 'Str.php';
require_once 'Required.php';
require_once 'Email.php';
require_once 'ProfileImage.php';
require_once 'RequireImage.php';
require_once 'Max100.php';

class Validator
{
    public $errors = [];

    private function makeValidation(ValidInterface $v)
    {
        return $v->validate();
    }

    public function rules($name, $value, array $rules)
    {
        foreach ($rules as $rule) {
            if ($rule == 'required') {
                $error = $this->makeValidation(new Required($name, $value));
            } else if ($rule == 'string') {
                $error = $this->makeValidation(new Str($name, $value));
            } else if ($rule == 'email') {
                $error = $this->makeValidation(new Email($name, $value));
            } else if ($rule == 'max:20') {
                $error = $this->makeValidation(new Max20($name, $value));
            } else if ($rule == 'max:100') {
                $error = $this->makeValidation(new Max100($name, $value));
            } else if ($rule == 'max:14') {
                $error = $this->makeValidation(new MaxTweet($name, $value));
            } else if ($rule == 'min:5') {
                $error = $this->makeValidation(new Min5($name, $value));
            } else if ($rule == 'numeric') {
                $error = $this->makeValidation(new Numeric($name, $value));
            } else if ($rule == 'required_image') {
                $error = $this->makeValidation(new  RequireImage($name, $value));
            } else if ($rule == 'image') {
                $error = $this->makeValidation(new ProfileImage($name, $value));
            } else {
                $error = '';
            }

            if ($error !== '')
                $this->errors[$name] = $error;

        }
    }
}
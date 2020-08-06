<?php


class EmailValidator extends AbstractValidator
{

    public function __construct($errorMessage='')
    {
        parent::__construct($errorMessage);
        if($errorMessage=='')$this->errorMessage = "Некорректный email";
    }

    public function validate($value, &$error)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            print $value;
            return true;
        }else{
            $error = $this->errorMessage;
            return false;
        }
    }
}
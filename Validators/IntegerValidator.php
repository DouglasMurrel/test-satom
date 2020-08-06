<?php


class IntegerValidator extends AbstractValidator
{

    public function __construct($errorMessage='')
    {
        parent::__construct($errorMessage);
        if($errorMessage=='')$this->errorMessage = "Неверное число";
    }

    public function validate($value, &$error)
    {
        if (filter_var($value, FILTER_VALIDATE_INT)) {
            return true;
        }else{
            $error = $this->errorMessage;;
            return false;
        }
    }
}
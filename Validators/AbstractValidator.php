<?php

abstract class AbstractValidator
{
    public $errorMessage;

    public function __construct($errorMessage='')
    {
        $this->errorMessage = $errorMessage;
    }

    abstract public function validate($value, &$error);
}
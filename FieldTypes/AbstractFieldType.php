<?php

abstract class AbstractFieldType
{
    public $options;
    public $clientOptions;
    public $name;
    public $value;

    public function __construct()
    {
        $this->options = [];//массив с подтегами (у селекта или радиокнопки - значения, которые выбираются, и т.д.)
        $this->clientOptions = [];//массив с параметрами тега
        $this->name = '';
        $this->value = '';
    }

    abstract public function __toString();
}
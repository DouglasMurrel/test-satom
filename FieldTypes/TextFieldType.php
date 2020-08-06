<?php


class TextFieldType extends AbstractFieldType
{
    public function __toString()
    {
        unset($this->clientOptions['value']);
        unset($this->clientOptions['name']);
        unset($this->clientOptions['id']);
        $return = '<input type="text"';
        $return .= ' name="'.$this->name.'"';
        $return .= ' id="'.$this->name.'"';
        foreach($this->clientOptions as $k=>$v){
            $return .= ' '.$k.'="'.$v.'"';
        }
        if($this->value!='')$return .= ' value="'.$this->value.'"';
        $return .= '>';
        return $return;
    }
}
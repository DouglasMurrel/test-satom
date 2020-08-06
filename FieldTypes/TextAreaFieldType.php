<?php


class TextAreaFieldType extends AbstractFieldType
{

    public function __toString()
    {
        unset($this->clientOptions['value']);
        unset($this->clientOptions['name']);
        unset($this->clientOptions['id']);
        $return = '<textarea';
        $return .= ' name="'.$this->name.'"';
        $return .= ' id="'.$this->name.'"';
        foreach($this->clientOptions as $k=>$v){
            $return .= ' '.$k.'="'.$v.'"';
        }
        $return .= '>';
        $return .= $this->value;
        $return .= '</textarea>';
        return $return;
    }
}
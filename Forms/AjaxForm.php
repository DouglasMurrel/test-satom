<?php


class AjaxForm extends AbstractForm//форма, которая сабмитится через Ajax
{
    public $returnString;

    public function getFieldValues()//тут собираем значения полей из запроса - все как в обычной форме
    {
        $fields = $this->getFields();//взяли список полей формы
        foreach($fields as $field){//идем по списку
            $field->value = $_POST[$field->name];//в каждое прописываем значение, пришедшее из запроса
        }
    }

    public function submitForm()//здесь вместо перехода на другой url будем генерировать текст вывода на изначальной странице
    {
        header('Content-type: application/json');
        $this->getFieldValues();//сформировали поля из запроса в виде ключ-значение
        if($this->validate()){//если свалидировали
            /*...*/ //тут можно что-нибудь сделать
            echo json_encode( ['success'=>$this->returnString], JSON_UNESCAPED_UNICODE );
            //вернули json со сгенерированной строкой, при рендере формы ее куда-нибудь вставим
        }else{
            echo json_encode( ['error'=>$this->getErrors()], JSON_UNESCAPED_UNICODE );
            //если ошибка, вернули список ошибок валидации в виде json - дальше ajax-коллбэк распределит, куда что
        }
    }
}
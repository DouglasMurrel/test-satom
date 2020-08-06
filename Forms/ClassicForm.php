<?php

class ClassicForm extends AbstractForm//классическая форма с кнопкой submit
{

    public $action;

    public function getFieldValues()//тут собираем значения полей из запроса
    {
        $fields = $this->getFields();//взяли список полей формы
        foreach($fields as $field){//идем по списку
            $field->value = $_POST[$field->name];//в каждое прописываем значение, пришедшее из запроса
        }
    }

    public function submitForm(){//основной обработчик
        $this->getFieldValues();//сформировали поля из запроса в виде ключ-значение
        if($this->validate()){//если свалидировали
            /*...*/ //тут можно что-нибудь сделать
            header("Location:".$this->action);//и переходим куда сказано в форме
            exit;
        }
        //а если не свалидировали, то у нас в форме содержится список ошибок в $form->getErrors(),
        //а также для кажого поля $field->$validateError содержит ошибку для конкретно этого поля
        //Все это в рендере формы можно получить и вставить в нужные места
    }
}
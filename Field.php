<?php


class Field
{
    /**
     * @var AbstractValidator[]
     */
    public $validators;//список валидаторов поля

    /**
     * @var string
     */
    public $validateError;//ошибка валидации

    public $name;//имя поля
    public $value;//значение поля

    /**
     * @var AbstractFieldType
     */
    public $fieldType;//тип поля (текстовое, селект и т.д.; используется только для рендера)

    /**
     * Field constructor.
     */
    public function __construct()//конструктор
    {
        $this->validateError = '';
        $this->name = '';
        $this->value = '';
        $this->validators = [];
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function validate(){//валидируем поле
        foreach($this->validators as $validator){//проходим по списку валидаторов
            if(is_a($validator, 'AbstractValidator')){//проверяем, что валидатор - потомок абстрактного валидатора
                if(!$validator->validate($this->value, $this->validateError)){//если не валидировали
                    return false;//возвращаем false. Ошибку записал сам валидатор
                }
            }else throw new Exception('Некорректный валидатор');
        }
        return true;
    }

    /**
     * @param $className
     * @param array $clientOptions
     * @param array $options
     * @return Field
     * @throws Exception
     */
    public function SetFieldType($className, $clientOptions=[], $options=[]){//метод для рендера - ставим конкретный тип поля
        //вывод в рендере выглядит примерно так: $form->AddField('name','value')->SetFieldType('TextFieldType', ['class'=>'myTextInputClass']);
        if(is_subclass_of($className,'AbstractFieldType')){
            $this->fieldType = new $className;
            $this->fieldType->clientOptions = $clientOptions;
            $this->fieldType->options = $options;
        }else throw new Exception('Некорректный тип поля: '.$className);
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(){//выводим поле
        if($this->fieldType){
            $this->fieldType->name = $this->name;
            $this->fieldType->value = $this->value;
            return $this->fieldType->__toString();
        }else return "";
    }
}
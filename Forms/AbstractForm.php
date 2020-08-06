<?php


abstract class AbstractForm
{
    /**
     * @var Field[]
     */
    protected $fields;//поля формы

    /**
     * @var array
     */
    protected $errors;//ошибки валидации

    /**
     * @return Field[]
     */
    public function getFields()//геттер списка полей
    {
        return $this->fields;
    }

    /**
     * @param $name
     * @param $value
     * @return Field
     */
    public function AddField($name, $value)//добавляем новое поле - просто в виде ключ-значение; рендер делается отдельным методом самого поля
    {
        $field = new Field();
        $field->name = $name;
        $field->value = $value;
        $this->fields[] = $field;
        return $field;
    }

    /**
     * @return array
     */
    public function getErrors()//геттер списка ошибок валидации
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function validate()//собственно валидация
    {
        $validated = true;
        foreach ($this->fields as $field) {//проходим по всем полям
            if (is_a($field, 'Field')) {
                if (!$field->validate()) {//пытаемся валидировать поле
                    $this->errors[$field->name] = $field->validateError;//если не валидировали - записываем ошибку в массив
                    $validated = false;//и ставим флажок в false
                }
            }
        }
        return $validated;
    }

    abstract public function getFieldValues();//собирает массив ключей-значений всех полей данной формы после отправки

    abstract public function submitForm();//основной обработчик формы
}
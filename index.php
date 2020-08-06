<?php

spl_autoload_register(function ($class_name) {
    if(file_exists($class_name . '.php'))include $class_name . '.php';
    if(file_exists("FieldTypes/".$class_name.'.php'))include "FieldTypes/".$class_name.'.php';
    if(file_exists("Validators/".$class_name.'.php'))include "Validators/".$class_name.'.php';
    if(file_exists("Forms/".$class_name.'.php'))include "Forms/".$class_name.'.php';
});

$form = new ClassicForm();
$form->action = $_SERVER['PHP_SELF'];
$field1 = $form->AddField('test','aaa');
$field1->validators[] = new EmailValidator();
$field2 = $form->AddField('test1','bbb');
$field2->validators[] = new IntegerValidator();

if(isset($_POST['save']) && $_POST['save']==1){
    $form->submitForm();
}

?>
<form method="post">
<?php
echo $field1->SetFieldType('TextFieldType', ['qq'=>'cc']);
?>
<div id='test-error'><?=$field1->validateError?></div>
<?php
echo $field2->SetFieldType('TextAreaFieldType', ['qq'=>'cc']);
?>
<div id='test1-error'><?=$field2->validateError?></div>
<input type="hidden" name="save" value="1">
<input type="submit" value="Go">
</form>
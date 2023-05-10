<?php 
class Form{
    public static function validate(array $form, array $field)
    {
        foreach ($field as $field)
        {
            if(!isset($form[$field]) || empty($form[$field]))
            {
                return false;
            }
        }
        return true;
    }
}
?>
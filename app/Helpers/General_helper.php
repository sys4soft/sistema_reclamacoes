<?php

function show_validation_error($field, $validation_errors)
{
    if(empty($validation_errors)){
        return '';
    }
    
    if(key_exists($field, $validation_errors)){
        return '<div class="text-danger">'.$validation_errors[$field].'</div>';
    }
}
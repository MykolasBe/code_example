<?php

use App\Accounts\Model;
use App\App;

function validate_password_format ($field_input, array &$field):bool
{
    if (!preg_match("/^(?=.*[a-z])(?=.*\\d).{8,12}$/i", $field_input)) {
        $field['error'] = 'Password must be 8-12chars and contain at least 1 number and 1 upper case letter';

        return false;
    }

    return true;
}
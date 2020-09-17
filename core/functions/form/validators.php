<?php

/**
 * Function checks if field is empty
 * @param $field_input
 * @param array $field
 * @return bool
 */
function validate_not_empty($field_input, array &$field): bool
{
    if (strlen($field_input) == 0) {
        $field['error'] = 'Field can not be empty';

        return false;
    }

    return true;
}


/**
 * Functions checks if given fields match
 * @param array $inputs
 * @param array $form
 * @param array $params
 * @return bool
 */
function validate_fields_match(array $inputs, array &$form, array $params): bool
{
    $comparison_field_id = $params[0];
    $comparison = $inputs[$comparison_field_id];

    foreach ($params as $field_id) {
        if ($comparison != $inputs[$field_id]) {
            $form['error'] = 'Fields do not match';

            return false;
        }
    }

    return true;
}


/**
 * Functions checks if phone number is the right format
 * @param $field_input
 * @param array $field
 * @return bool
 */
function validate_phone($field_input, array &$field): bool
{
    if (!preg_match("/^\+3706[0-9]{7}$/", $field_input)) {
        $field['error'] = 'Wrong phone format';

        return false;
    }

    return true;
}

/**
 * Functions checks if email is the right format
 * @param $field_input
 * @param array $field
 * @return bool
 */
function validate_email($field_input, array &$field): bool
{
    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $field_input)) {
        $field['error'] = 'Enter email';

        return false;
    }

    return true;
}


/**
 * Functions checks if email is unique and not used
 * @param $field_input
 * @param array $field
 * @return bool
 */
function validate_email_unique($field_input, array &$field): bool
{
    if (!App\App::$db->mySQL->query(
        "SELECT * FROM users WHERE email=$field_input"
    )) {
        $field['error'] = 'Email already registered';

        return false;
    }

    return true;
}

/**
 * Functions validates login
 * @param array $inputs
 * @param array $form
 * @return bool
 */
function validate_login(array $inputs, array &$form): bool
{
    $email = $inputs['email'];


    if ($data = App\App::$db->mySQL->query(
        "SELECT * FROM users WHERE email='$email'"
    )) {
        if (password_verify($inputs['password'],$data->fetch_object()->password)){
            return true;
        }
    } else {
        $form['error'] = 'incorrect password or email';

        return false;
    }

}



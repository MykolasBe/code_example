<?php
/**
 * Function protects from harmful inputs(POST)
 * @param array $form
 * @return array|null
 */
function get_filtered_input(array $form): ?array
{
    $filter_params = [];

    if (isset($form['fields'])) {
        foreach ($form['fields'] as $field_id => $field) {
            if (isset($field['filter'])) {
                $filter_params[$field_id] = $field['filter'];
            } else {
                $filter_params[$field_id] = FILTER_SANITIZE_SPECIAL_CHARS;
            }
        }
    }

    return filter_input_array(INPUT_POST, $filter_params);
}


/**
 * Function that calls validators
 * Returns true if valid
 * @param array $form
 * @param $input
 * @return bool
 */
function validate_form(array &$form, array $input): bool
{
    $form_valid = true;

    foreach ($form['fields'] ?? [] as $field_id => &$field) {
        $field['value'] = $input[$field_id];
        foreach ($field['validators'] ?? [] as $validator_id => $validator) {
            if (is_array($validator)) {
                $valid_check = $validator_id($input[$field_id], $field, $validator);
            } else {
                $valid_check = $validator($input[$field_id], $field);
            }
            $form['fields'][$field_id] = $field;

            if (!$valid_check) {
                $form_valid = false;
                break;
            }
        }
    }
    if ($form_valid) {
        foreach ($form['validators'] ?? [] as $validator_id => $validator) {
            if (is_array($validator)) {
                $valid_check = $validator_id($input, $form, $validator);
            } else {
                $valid_check = $validator($input, $form);
            }
            if (!$valid_check) {
                $form_valid = false;
                break;
            }
        }
    }

    if (isset($form['callbacks']['success']) && $form_valid) {
        $form['callbacks']['success']($form, $input);
    }

    return $form_valid;
}

function fill_form(array &$form, array $inputs): void
{
    foreach ($inputs as $input_id => $input) {
        $form['fields'][$input_id]['value'] = $input;
    }
}

function get_form_action(): ?string
{
    return $_POST['action'] ?? null;
}



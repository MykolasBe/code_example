<?php

namespace Core\Views;
use Core\Abstracts\Views;
use Core\View;

class Form extends View
{

    public function render($path = ROOT . '/core/templates/form.tpl.php')
    {
       return parent::render($path);
    }

    /**
     * Validates form based on $this->data
     * Does NOT call any callbacks, just returns the result
     * of the form
     *
     * @return bool
     */
    public function validate(): bool
    {
        $form_valid = true;
        $input = $this->getSubmitData();

        foreach ($this->data['fields'] ?? [] as $field_id => &$field) {
            $field['value'] = $input[$field_id];
            foreach ($field['validators'] ?? [] as $validator_id => $validator) {
                if (is_array($validator)) {
                    $valid_check = $validator_id($input[$field_id], $field, $validator);
                } else {
                    $valid_check = $validator($input[$field_id], $field);
                }
                $this->data['fields'][$field_id] = $field;

                if (!$valid_check) {
                    $form_valid = false;
                    break;
                }
            }
        }
        if ($form_valid) {
            foreach ($this->data['validators'] ?? [] as $validator_id => $validator) {
                if (is_array($validator)) {
                    $valid_check = $validator_id($input, $this->data, $validator);
                } else {
                    $valid_check = $validator($input, $this->data);
                }
                if (!$valid_check) {
                    $form_valid = false;
                    break;
                }
            }
        }

        return $form_valid;
    }

    /**
     * Checks if the form is submitted
     *
     * Gets submit action from $_POST, and checks if form array
     * has a button with such index
     *
     * @return bool
     */
    public function isSubmitted(): bool
    {
        if (isset($_POST['action'])) {
            foreach ($this->data['buttons'] as $id => $button) {
                if ($_POST['action'] == $id) {

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Gets form submitted data
     * If $filtered = false, returns $_POST if not empty (or null)
     * If $filtered = true, returns filtered $_POST array
     * based on form array: $this->data
     *
     * @param bool $filter
     * @return array|null
     */
    public function getSubmitData($filter = true): ?array
    {
        if ($filter) {

            $filter_params = [];
            if (isset($this->data['fields'])) {
                foreach ($this->data['fields'] as $field_id => $field) {
                    if (isset($field['filter'])) {
                        $filter_params[$field_id] = $field['filter'];
                    } else {
                        $filter_params[$field_id] = FILTER_SANITIZE_SPECIAL_CHARS;
                    }
                }
            }

            return filter_input_array(INPUT_POST, $filter_params);
        } else {
            return $_POST ?: null;
        }
    }

    /**
     * Returns value by field ID
     * @param string $field_id
     * @return string|null
     */
    public function getSubmitValue(string $field_id): ?string
    {
        return $this->getSubmitData()[$field_id] ?? null;
    }
    /**
     * Determines which button was pressed by reading "action"
     * index in $_POST.
     * If $_POST is empty, or doesnt contain action, returns null
     *
     * @return string|null
     */
    static function getSubmitAction(): ?string
    {
        return $_POST['action'] ?? null;
    }
}
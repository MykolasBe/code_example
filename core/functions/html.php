 <?php /**
  * Function generates HTML attributes from array
  * @param array $array
  * @return string
  */
 function html_attr(array $array): string
 {
     $attributes = '';

     foreach ($array as $key => $attr) {
         $attributes .= "$key=\"$attr\" ";
     }
     return $attributes;
 }

 /**
  * Function generates input HTML attributes
  * @param $field_id
  * @param array $field
  * @return string
  */
 function input_attr($field_id ,array $field){
     return html_attr(($field['extra']['attr'] ?? []) +
         [
             'name' => $field_id,
             'type' => $field['type'],
             'value' => $field['value'] ?? ''
         ]);
 }

 /**
  * Function generates select HTML attributes
  * @param $field_id
  * @param array $field
  * @return string
  */
 function select_attr(string $field_id, array $field): string
 {
     $attrs = $field['extra']['attr'] ?? [];
     $attrs += [
         'name' => $field_id,
     ];
     return html_attr($attrs);
 }

 /**
  * Function generates options HTML attributes
  * @param string $option_id
  * @param array $field
  * @return string
  */
 function option_attr(string $option_id, array $field): string
 {
     $attrs = $field['extra']['attr'] ?? [];
     $attrs += [
         'value' => $option_id,
     ];
     if ($field['value'] == $option_id) {
         $attrs['selected'] = true;
     }
     return html_attr($attrs);
 }

 /**
  * Function generates radio HTML attributes
  * @param $field_id
  * @param $option_id
  * @param array $field
  * @return string
  */
 function radio_attr ($field_id, $option_id, array $field){
     return html_attr(($field['extra']['attr'] ?? []) + [
             'name' => $field_id,
             'type' => $field['type'],
             'value' => $option_id,
         ]);
 }
 /**
  * Function generates textarea HTML attributes
  * @param $field_id
  * @param array $field
  * @return string
  */
 function textarea_attr($field_id ,array $field){
     return html_attr(($field['extra']['attr'] ?? []) + ['name' => $field_id,]);
 }

 /**
  * Function generates button HTML attributes
  * @param $button_id
  * @param array $button
  * @return string
  */
 function button_attr($button_id ,array $button){
     return html_attr(($button['extra']['attr'] ?? []) +
         [
             'name' => 'action',
             'value' => $button_id,
         ]);
 }
 ?>

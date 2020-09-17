 <?php /**
  *funkc sugeneruoja html formos atributus is masyvo
  * @param array $array atributu masyvas
  * @return string grazina sudeta atributu stringa
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
  * F-cija generuoja input html atributus
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
  * F-cija generuoja select atributus
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

 function radio_attr ($field_id, $option_id, array $field){
     return html_attr(($field['extra']['attr'] ?? []) + [
             'name' => $field_id,
             'type' => $field['type'],
             'value' => $option_id,
         ]);
 }
 /**
  * F-cija generuoja textarea atributus
  * @param $field_id
  * @param array $field
  * @return string
  */
 function textarea_attr($field_id ,array $field){
     return html_attr(($field['extra']['attr'] ?? []) + ['name' => $field_id,]);
 }

 /**
  * F-cija generuoja button atributus
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
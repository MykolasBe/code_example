<?php
/**
 * @param array $array
 * @param string $file
 * @return bool
 */
function array_to_file(array $array, string $file): bool
{
    $string = json_encode($array);
    $success = file_put_contents($file, $string);
    if ($success !== false) {
        return true;
    } else {
        return false;
    }
}


function file_to_array(string $file)
{
    if (file_exists($file)) {
        $data = file_get_contents($file);
        if ($data !== false) {
            return json_decode($data, true);
        }
    } else {
        return false;
    }
}

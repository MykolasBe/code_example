<?php

namespace Core;

class DataHolder
{
    public function __construct(array $data = null)
    {
        if ($data) [
            $this->_setData($data)
        ];
    }

    /**
     * @param string $property_key
     * @param $value
     */
    public function __set(string $property_key, $value)
    {

        if ($method = $this->_getSetterMethod($property_key)) {
            $this->{$method}($value);
        }
    }

    /**
     * @param string $property_key
     * @return mixed
     */

    public function __get(string $property_key)
    {
        if ($method = $this->_getGetterMethod($property_key)) {

            return $this->{$method}();
        }
    }

    /**
     * Checks if requested set method is exists
     * @param string $key
     * @return string
     */
    private function _getSetterMethod(string $key): ?string
    {
        $method = $this->_keyToMethod('set', $key);
        if (method_exists($this, $method)) {
            return $method;
        }

        return null;
    }

    /**
     * Checks if requested get method is exists
     * @param string $key
     * @return string
     */
    private function _getGetterMethod(string $key): ?string
    {
        $method = $this->_keyToMethod('get', $key);

        if (method_exists($this, $method)) {
            return $method;
        }

        return null;
    }
    /**
     * Sets data form given array
     * @param array $data
     */
    public function _setData(array $data): void
    {
        foreach ($data as $property_key => $value) {
            $this->__set($property_key, $value);
        }
    }

    /**
     * Gets set data
     * @return array
     */
    public function _toArray(): array
    {
        $data = [];

        foreach ($this->_getPropertyKeys() as $property_key) {
            $data[$property_key] = $this->__get($property_key);
        }

        return $data;
    }

    /**
     * Removes underscores
     * Combines prefix & key to method name
     * @param string $prefix
     * @param string $key
     * @return string
     */
    private function _keyToMethod(string $prefix, string $key): string
    {
        return $prefix . str_replace('_', '', $key);
    }

    /**
     * Generates key name from method name
     * @param string $prefix
     * @param string $method
     * @return string
     */
    private function _methodToKey(string $prefix, string $method): string
    {
        $s_case = strtolower(preg_replace('/\B([A-Z])/', '_$0', $method));

        return str_replace($prefix . '_', '', $s_case);
    }

    /**
     * Returns array of property keys
     * @return array
     */
    private function _getPropertyKeys(): array
    {
        $keys = [];
        $methods = get_class_methods($this);

        foreach ($methods as $method) {
            if (preg_match("/^get/", $method)) {
                $keys[] = $this->_methodToKey('get', $method);
            }
        }

        return $keys;
    }
}
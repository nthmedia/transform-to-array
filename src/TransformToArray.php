<?php


namespace Nthmedia\TransformToArray;

class TransformToArray
{
    /**
     * @param array|object $data
     * @return array|string
     */
    public static function convert($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        if (is_array($data)) {
            return array_map([__CLASS__, __FUNCTION__], $data);
        }

        return $data;
    }
}
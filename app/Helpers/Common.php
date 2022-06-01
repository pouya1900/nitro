<?php
/**
 * check input mobile and result 11 digits mobile
 * @param $mobile
 *
 * @return string
 */
if (!function_exists('makeMobileByZero')) {
    /**
     * @param $mobile
     * @return string
     */
    function makeMobileByZero($mobile)
    {
        if (strlen((string)$mobile) == 10) {
            $mobile = 0 . $mobile;
        }
        return $mobile;
    }
}

if (!function_exists('makeMobileWithoutZero')) {
    /**
     * @param $mobile
     * @return false|string
     */
    function makeMobileWithoutZero($mobile)
    {
        if (strlen((string)$mobile) == 11) {
            $mobile = substr($mobile, 1, 10);
        }
        return $mobile;
    }
}

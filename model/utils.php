<?php

class utils {

    static function output_html($stream, $array_cambios = null) {
        if (!is_null($array_cambios)) {
            $archivo = file_get_contents($stream);
            $indices = array_keys($array_cambios);
            $valores = array_values($array_cambios);
            $stream = str_replace($indices, $valores, $archivo);
            return $stream;
        } else {
            return $stream;
        }
    }

    static function input_sanitize($string) {
        $array_danger = array("'", '"', '\u2019', '%', '&#8217;');
        $string = str_replace($array_danger, "", $string);
        $string = filter_var($string, FILTER_SANITIZE_STRING);
        return $string;
    }

    static function sanitize_output($buffer) {

        $search = array(
            '/\>[^\S ]+/s', // strip whitespaces after tags, except space
            '/[^\S ]+\</s', // strip whitespaces before tags, except space
            '/(\s)+/s', // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );

        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer_output = preg_replace($search, $replace, $buffer);
        return $buffer_output;
    }

    static function time_UnixToMySQL($unixtime) {
        $mysql_time = date('Y-m-d H:i:s', $unixtime);
        return $mysql_time;
    }

    static function time_MySQLToUnix($mysqltime) {
        $timestamp = strtotime($mysqltime);
        return $timestamp;
    }

    static function formatTime($mysqltime, $format = "d-m-Y g:i A") {
        $time = strtotime($mysqltime);
        $myFormatForView = date($format, $time);
        return $myFormatForView;
    }

}

<?php
if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '') {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}
function reformat_date($date){
    return DateTime::createFromFormat('Y-m-d H:i:s' , $date )->format('d. F, Y G:i');
}


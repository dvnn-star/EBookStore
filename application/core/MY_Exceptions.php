<?php
class MY_Exceptions extends CI_Exceptions {

    public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
    {
        // If the status code is 403, force the 403 template
        if ($status_code === 403) {
            $template = 'error_403';
        }

        return parent::show_error($heading, $message, $template, $status_code);
    }
}
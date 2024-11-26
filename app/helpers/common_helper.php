<?php
if ( ! function_exists('set_flash_alert')) {
    function set_flash_alert($alert, $message) {
        $LAVA =& lava_instance();
        $LAVA->session->set_flashdata(array('alert' => $alert, 'message' => $message));
    }
}
if ( ! function_exists('flash_alert')) {
    function flash_alert() {
        $LAVA =& lava_instance();
        if($LAVA->session->flashdata('alert') !== NULL) {
            echo '
            <div class="alert alert-' . $LAVA->session->flashdata('alert') .'">
            <i classs=icon-remove close" data-dismiss="alert"></i>
            ' . $LAVA->session->flashdata('message'). '
            </div>';
        }
    }
}
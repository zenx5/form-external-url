<?php

class FormExternalUrl {

    public static function activation() {

    }

    public static function deactivation() {

    }

    public static function init() {
        add_action( "wpforms_ajax_submit_completed", [$this, "connect_url"] );
    }

    public static function connect_url($form_id) {
        // Deberiamos tener una zona de configuracion donde asociar el ID con una url

        // Aqui obtenemos los datos del formulario y ya con esto podemos hacer el cURL
        $form_data = wpforms()->form->get( $form_id, [ 'content_only' => true ] );

    }

}
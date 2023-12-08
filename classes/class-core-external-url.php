<?php

class FormExternalUrl {

    public static function activation() {

    }

    public static function deactivation() {

    }

    public static function init() {
        add_action('admin_menu', ['FormExternalUrl','admin_menu']);
        add_action( "wpforms_ajax_submit_completed", ['FormExternalUrl', "connect_url"] );
        // add_filter( "wpforms_frontend_confirmation_message", [$this, "response_filter"] );
    }

    public static function admin_menu(){
        /*
            Aqui hacemos el diseño de la parte de url, deberia bastar con un 
            select para el id del formulario
            y un input para la url
            se guardan y con el metodo "update_option"

        */
        add_menu_page(
            "External Url",
            "External Url",
            "manage_options",
            "external-url",
            function(){
                ?>
                    <div style="margin: 40px;">
                    </div>
                <?php
            },
            "",
            6
        );
    }

    public static function connect_url($form_id) {
        // Deberiamos tener una zona de configuracion donde asociar el ID con una url
        // if( $form_id==="9492" ) {
        //     // Aqui obtenemos los datos del formulario y ya con esto podemos hacer el cURL
        //     $form_data = wpforms()->form->get( $form_id, [ 'content_only' => true ] );
        //     $data = self::extract_data( $form_data );
        //     //cURL

        // }


    }

    public static function extract_data( $form_data ) {

        return $form_data;
    }

}
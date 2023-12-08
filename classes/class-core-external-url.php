<?php

class FormExternalUrl {

    public static function activation() {

    }

    public static function deactivation() {

    }

    public static function init() {
        add_action('admin_menu', [__CLASS__,'admin_menu']);
        add_action( "wpforms_ajax_submit_completed", [__CLASS__, "connect_url"]);
        add_action( 'wp_ajax_update_settings', [__CLASS__, 'update_settings']);
        add_action( 'wp_ajax_get_settings', [__CLASS__, 'get_settings']);
        add_action( 'wp_ajax_nopriv_get_settings', [__CLASS__, 'get_settings']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'script_head']);

        // add_filter( "wpforms_frontend_confirmation_message", [$this, "response_filter"] );
    }

    public static function script_head() {
        wp_register_script( 'selector-fetch', plugins_url( '../src/js/get-select.js' , __FILE__ ) );
        wp_enqueue_script( 'selector-fetch' );

    }

    public static function update_settings() {
        if( isset( $_POST["wp_forms_external_id"] ) ) {
            update_option("wp_forms_external_id", $_POST["wp_forms_external_id"]);
        }
        if( isset( $_POST["wp_forms_external_selector"] ) ) {
            update_option("wp_forms_external_selector", $_POST["wp_forms_external_selector"]);
        }
    }

    public static function get_settings() {
        $id = get_option("wp_forms_external_id", "");
        $selector = get_option("wp_forms_external_selector", "");

        echo json_encode([
            "id" => $id,
            "selector" => $selector
        ]);
        die();
    }

    public static function admin_menu(){
        add_menu_page(
            "External Url",
            "External Url",
            "manage_options",
            "external-url",
            function(){
                $id = get_option("wp_forms_external_id", "");
                $selector = get_option("wp_forms_external_selector","");
                ?>
                    <script>
                        (async ()=>{
                            console.log("AQUIIIII")

                            const response = await fetch(ajaxurl, {
                                method:'post',
                                headers:{
                                    'Content-Type':'application/x-www-form-urlencoded'
                                },
                                body: `action=get_settings`,
                            })

                            const { id, selector } = await response.json()
                        })()
                    </script>
                    <div style="margin: 40px;">
                        <table>
                            <tr>
                                <th>Selector</th>
                                <td>
                                    <input type="text" name="wp_forms_external_selector" value="<?=$selector?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th>Form ID:</th>
                                <td>
                                    <input type="text" name="wp_forms_external_id" value="<?=$id?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button style="padding: 5px 10px; width:100%;" id="update-forms">Actualizar</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <script>
                        jQuery("#update-forms")
                            .click(function(){
                                const id = document.querySelector('input[name="wp_forms_external_id"]').value
                                const selector = document.querySelector('input[name="wp_forms_external_selector"]').value
                                const response = fetch(ajaxurl, {
                                    method:'post',
                                    headers:{
                                        'Content-Type':'application/x-www-form-urlencoded'
                                    },
                                    body: `action=update_settings&wp_forms_external_id=${id}&wp_forms_external_selector=${selector}`,
                                }).then( response => document.location.reload() )
                            })

                    </script>
                <?php
            },
            "",
            6
        );
    }

    public static function connect_url($form_id) {
        //$form_id = isset( $_POST['wpforms']['id'] ) ? absint( $_POST['wpforms']['id'] ) : 0;
        
        // Deberiamos tener una zona de configuracion donde asociar el ID con una url
        // if( $form_id==="9492" ) {
        //     // Aqui obtenemos los datos del formulario y ya con esto podemos hacer el cURL
             $form_data = $_POST['wpforms'];
             die(json_encode($_POST['wpforms']));
        //     $data = self::extract_data( $form_data );
        //     //cURL

        // }


    }

    public static function extract_data( $form_data ) {

        return $form_data;
    }

}
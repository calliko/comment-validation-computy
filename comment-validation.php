<?php
/**
 * Plugin Name: Валидация комментариев
 * Plugin URI: computy.ru
 * Description: Добавляет настраиваемые формы проверки JQuery в форме комментариев WordPress
 * Version: 1.0
 * Author: Tokmakov A.V.
 * Author URI: http://www.computy.ru
 * License: GPL
 */

function pbd_vc_scripts() {
    if(is_single() ) {
        wp_enqueue_script(
            'jquery-validate',
            plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js',
            array('jquery'),
            '1.10.0',
            true
        );

        wp_enqueue_style(
            'jquery-validate',
            plugin_dir_url( __FILE__ ) . 'css/style.css',
            array(),
            '1.0'
        );
    }
}
add_action('template_redirect', 'pbd_vc_scripts');

/**
 * Инициировать сценарий.
 * Вызывает параметры проверки в форме комментария.
 */
function pbd_vc_init() { ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {

            $('#new-post, #commentform').validate({
                rules: {
                    author: {
                        required: true,
                        minlength: 2
                    },
                    bbp_anonymous_name:{
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    bbp_anonymous_email:{
                        required: true,
                        email: true
                    },
                    bbp_reply_content: {
                        required: true,
                        minlength: 20
                    },

                    comment: {
                        required: true,
                        minlength: 20
                    }
                },

                messages: {
                    author: "Пожалуйста, укажите Ваше имя.",
                    bbp_anonymous_name:"Пожалуйста, укажите Ваше имя.",
                    email: "Пожалуйста, введите действительный адрес электронной почты.",
                    bbp_anonymous_email:"Пожалуйста, введите действительный адрес электронной почты.",
                    bbp_reply_content:"Сообщение должно быть не менее 20 символов.",
                    comment: "Сообщение должно быть не менее 20 символов."
                }
            });
        });
    </script>
<?php }
add_action('wp_footer', 'pbd_vc_init', 999);
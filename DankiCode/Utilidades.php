<?php

    namespace DankiCode;

    class Utilidades {
        public static function redirect($url) {
            echo ('<script>window.location.href="'.$url.'"</script>');
        }

        public static function alerta($mensagem) {
            echo ('<script>window.alert("'.$mensagem.'")</script>');
        }
    }

?>
<?php
    class HomeController {
        public static function View( $params ) {
            global $format;
            include "views/$format/home/view.php";
        }
    }

?>

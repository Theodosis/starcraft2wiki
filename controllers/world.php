<?php
    require_once 'models/world.php';
    class WorldController {
        public static function listing(){
            global $format;
            $worlds = World::ListAll();

            include "views/$format/world/listing.php";
        }
        public static function view(){
            global $format;
            $world = World::GetById( $params[ 'id' ] );
            include "views/$format/world/view.php";
        }
    }
?>

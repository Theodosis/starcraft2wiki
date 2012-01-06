<?php
    require 'controllers/controller.php';
    $params = array_merge( $_GET, $_POST, $_FILES );
    unset( $_GET, $_POST, $_FILES );
    Controller::Handle( $params );
?>

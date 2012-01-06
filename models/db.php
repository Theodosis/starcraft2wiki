<?php
    global $settings;
    global $dbresource; 
    $dbresource = mssql_connect( $settings[ 'db' ][ 'host' ], $settings[ 'db' ][ 'user' ], $settings[ 'db' ][ 'pass' ] ) or die( mssql_get_last_message() );
    mssql_select_db( $settings[ 'db' ][ 'name' ] ) or die( mssql_get_last_message() );
    session_start();
    //mssql_query( "SET NAMES UTF8;" );

    // function db executes the query sql after binding the attributes bind
    // and returns a mssql resource.
    function db( $sql, $bind = false ) {
        if ( $bind == false ) {
            $bind = array();
        }
        foreach ( $bind as $key => $value ) {
            if ( is_string( $value ) ) {
                $value = addslashes( $value );
                $value = '"' . $value . '"';
            }
            else if ( is_array( $value ) ) {
                foreach ( $value as $i => $subvalue ) {
                    $value[ $i ] = addslashes( $subvalue );
                }
                $value = "('" . implode( "', '", $value ) . "')";
            }
            else if ( is_null( $value ) ) {
                $value = '""';
            }
            $bind[ ':' . $key ] = $value;
            unset( $bind[ $key ] );
        }
        $finalsql = strtr( $sql, $bind );
        $res = mssql_query( $finalsql );
        if ( $res === false ) {
            throw new Exception(
                "SQL query failed with the following error:\n\""
                . mssql_get_last_message()
                . "\"\n\nThe query given was:\n"
                . $sql
                . "\n\nThe SQL bindings were:\n"
                . print_r( $bind, true )
                . "The query executed was:\n"
                . $finalsql
            );
        }
        return $res;
    }

    // function db_array executes the query sql after binding the attributes bind
    // and returns the results in an array
    function db_array( $sql, $bind = false, $id_column = false ) {
        $res = db( $sql, $bind );
        $rows = array();
        if ( $id_column !== false ) {
            while ( $row = mssql_fetch_array( $res, MSSQL_ASSOC ) ) {
                $rows[ $row[ $id_column ] ] = $row;
            }
        }
        else {
            while ( $row = mssql_fetch_array( $res, MSSQL_ASSOC ) ) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    // function db_insert inserts a row with values on set in the specified table
    function db_insert( $table, $set ) {
        $names = array();
        $values = array();
        foreach ( $set as $field => $value ) {
            $names[] = $field;
            $values[] = ":$field";
        }
        $q = db(
            'INSERT INTO ['
            . $table
            . '] ( '
            . implode( ',', $names )
            . ') VALUES( '
            . implode( ',', $values )
            . ' ) SELECT LAST_INSERT_ID=@@IDENTITY;',
            $set
        );
        $id = mssql_fetch_assoc( $q );
        return $id[ 'LAST_INSERT_ID' ];
    }
    
    // function db_delete deletes a subset of the specified table using the where array to select them
    function db_delete( $table, $where ) {
        global $dbresource;
        $fields = array();
        foreach ( $where as $field => $value ) {
            $fields[] = "$field = :$field";
        }
        $res = db(
            'DELETE FROM '
            . $table
            . ' WHERE '
            . implode( ' AND ', $fields ),
            $where
        );
        return mssql_rows_affected( $dbresource );
    }

    // function db_update updates a subset of the selected table using the where array, and sets 
    // the values defined by set.
    function db_update( $table, $where, $set ) {
        global $dbresource;
        $wfields = array();
        $wreplace = array();
        foreach ( $where as $field => $value ) {
            $wfields[] = "$field = :where_$field";
            $wreplace[ 'where_' . $field ] = $value;
        }
        $sfields = array();
        $sreplace = array();
        foreach ( $set as $field => $value ) {
            $sfields[] = "$field = :set_$field";
            $sreplace[ 'set_' . $field ] = $value;
        }
        $res = db(
            'UPDATE '
            . $table .
            ' SET '
            . implode( ', ', $sfields ) .
            ' WHERE '
            . implode( ' AND ', $wfields ),
            array_merge( $wreplace, $sreplace )
        );
        return mssql_rows_affected( $dbresource );
    }
    
    // function db_select selects a subset of the specified table, using the where array. 
    // If where is omitted it returns the whole table.
    function db_select( $table, $where = array(1=>1) ) {
        $wreplace = array();
        $wfields = array();
        foreach ( $where as $field => $value ) {
            $wfields[] = "$field = :where_$field";
            $wreplace[ 'where_' . $field ] = $value;
        }
        return db_array(
            'SELECT
                *
            FROM
                ' . $table . '
            WHERE
                ' . implode( ' AND ', $wfields ),
                $wreplace
        );
    }
    
    // function db_fetch takes a mssql resource and returns it's results into an array.
    function db_fetch( $res ) {
        $ret = array();
        while ( $row = mssql_fetch_array( $res, MSSQL_ASSOC ) ) {
            $ret[] = $row;
        }
        return $ret;
    }
?>

Object.defineProperty( Object.prototype, "clone", {
    value: function(){
        return jQuery.extend( true, {}, this );
    }
} );


$( function(){
    $( 'ul.menu .register' ).click( function(){
        $( 'form.register' ).show().siblings().hide();
        return false;
    } );
    $( 'ul.menu .login' ).click( function(){
        $( 'form.login' ).show().siblings().hide();
        return false;
    } );
    $( '.admin_view form select.select' ).change( function(){
        $.get( '?controller=building&method=view', {
            id: $( this ).val(),
            format: 'json',
            verbose: 'true'
        }, function( data ){
            $( '.item' ).show()
                .find( '[name=id]' ).val( data.id ).end()
                .find( '[name=name]' ).val( data.name ).end()
                .find( '[name=health]' ).val( data.health ).end()
                .find( '[name=minerals]' ).val( data.minerals ).end()
                .find( '[name=gas]' ).val( data.gas ).end()
                .find( '[name=time]' ).val( data.time ).end()
                .find( '[name=raceId]' ).val( data.raceId ).end();
            
            append( selected( data.allUnits, data.units ), $( '[name=units]' ) );
            append( selected( data.allBuildingUpgrades, data.buildingupgrades ), $( '[name=buildingupgrades]' ) );
            append( selected( data.allBuildingUpgrades, data.upgrades ), $( '[name=upgrades]' ) );
            append( selected( data.allUnitUpgrades, data.unitupgrades ), $( '[name=unitupgrades]' ) );
            append( selected( data.allAddons, data.addons ), $( '[name=addons]' ) );

        } );

    } );

            
    function append( what, where ){
        var items = $( '<div></div>' );
        for( var i in what ){
            var item = what[ i ];
            items.append( '<option ' + ( item.selected ? 'selected="selected"' : '' ) + 'value="' + item.id + '">' + item.name + '</option>' );
        }
        where.empty().append( items.children() );
    }
    function selected( all, few ){
        var ret = all.clone();
        for( var i in ret ){
            var item = ret[ i ];
            for( var j in few ){
                var selected = few[ j ];
                if( item.id == selected.id ){
                    ret[ i ].selected = true;
                    break;
                }
            }
        }
        return ret;
    }
} );

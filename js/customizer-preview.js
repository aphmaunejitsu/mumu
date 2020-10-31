( function( $ ) {
    // Codes here.
  wp.customize( 'custom-logo', function( $value ) {
    value.bind( function(to) {
      $( '.site-icon amp-img' ).src( $value )
    } )
  } )
} )( jQuery );

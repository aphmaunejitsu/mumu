(function($) {
    // Codes here.
  wp.customize('custom-logo', function( $value ) {
    value.bind( function(to) {
      $('header#mumu-top amp-img' ).src( $value )
    })
  })
})(jQuery);

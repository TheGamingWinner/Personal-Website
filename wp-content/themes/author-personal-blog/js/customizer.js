/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			if ('#ffffff' === to) {
				$('body.home').removeClass('custom-background');
			}else{
				$('body.home').addClass('custom-background');
			}
		} );
	} );
	wp.customize( 'background_image', function( value ) {
		value.bind( function( to ) {
			if ('' === to || null === to || 'undefined' === to) {
				$('body.home').removeClass('custom-background');
			}else{
				$('body.home').addClass('custom-background');
			}
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	// About Me Section Social Links Colors
	wp.customize('about_section_social_links_colors', function(value) {
        // When the value changes.
        value.bind(function(newval) {
            // Generate the CSS.
            var cssContent = `.about-section-social-links .social-link a{
                background-color: ${newval['icon_bg_color']};
                color: ${newval['icon_text_color']};
            }
            .about-section-social-links .social-link a:hover,.about-section-social-links .social-link a:active{
                background-color: ${newval['icon_bg_h_color']};
                color: ${newval['icon_text_h_color']};
            }`;

            // Check if we already have a <style> in the <head> referencing this control.
            if (
                null === document.getElementById('kirki-postmessage-about_section_social_links_colors') ||
                'undefined' === typeof document.getElementById('kirki-postmessage-about_section_social_links_colors')
            ) {

                // Append the <style> to the <head>.
                jQuery('head').append('<style id="kirki-postmessage-about_section_social_links_colors"></style>');
            }

            // Add the CSS to the <style> and append.
            jQuery('#kirki-postmessage-about_section_social_links_colors').text(cssContent);
            jQuery('#kirki-postmessage-about_section_social_links_colors').appendTo('head');
        });
    });
} )( jQuery );
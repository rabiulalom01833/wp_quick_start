/*!
 * Additional js for Elementor
 *
 * Name    : Visual Portfolio
 * Version : 1.16.2
 * Author  : nK https://nkdev.info
 */
import { throttle } from 'throttle-debounce';

const {
    elementorFrontend,
    VPAdminElementorVariables: variables,
} = window;

const $ = window.jQuery;
const $wnd = $( window );

$( window ).on( 'elementor/frontend/init', function( $data ) {
    if ( ! variables ) {
        return;
    }

    const {
        target: elementorWindow,
    } = $data;

    // add fake iframe width, so @media styles will work fine.
    function maybeResizePreviews() {
        const elementorWidth = elementorWindow.jQuery( elementorWindow.document ).width();

        elementorWindow.jQuery.find( '.visual-portfolio-elementor-preview iframe' ).forEach( ( item ) => {
            const $this = $( item );
            const parentWidth = $this.parent().width();

            $this.css( {
                width: elementorWidth,
            } );

            if ( item.iFrameResizer ) {
                item.iFrameResizer.sendMessage( {
                    name: 'resize',
                    width: parentWidth,
                } );
                item.iFrameResizer.resize();
            }
        } );
    }

    // window resize.
    $wnd.on( 'resize', throttle( 300, maybeResizePreviews ) );

    // added/changed widget.
    elementorFrontend.hooks.addAction( 'frontend/element_ready/visual-portfolio.default', $scope => {
        const $block = $( $scope ).find( '.visual-portfolio-elementor-preview' );
        const $frame = $block.find( 'iframe' );
        const id = $block.attr( 'data-id' );
        const iframeURL = variables.preview_url + ( variables.preview_url.split( '?' )[ 1 ] ? '&' : '?' ) + `vp_preview_frame=true&vp_preview_type=elementor&vp_preview_frame_id=${ id }`;

        $frame.attr( 'src', iframeURL );

        // resize iframe
        if ( $.fn.iFrameResize ) {
            $frame.iFrameResize( {
                onInit() {
                    maybeResizePreviews();
                },
            } );
        }
    } );
} );

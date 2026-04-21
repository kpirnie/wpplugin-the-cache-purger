<?php
/** 
 * VARNISH module
 * 
 * This file contains the varnish purge methods
 * 
 * @since 8.1
 * @author Kevin Pirnie <me@kpirnie.com>
 * @package The Cache Purger
 * 
*/

// We don't want to allow direct access to this
defined( 'ABSPATH' ) || die( 'No direct script access allowed' );

// check if this trait already exists
if( ! trait_exists( 'VARNISH' ) ) {

    /**
     * Trait FILE
     *
     * This trait contains the varnish purge methods
     *
     * @since 8.1
     * @author Kevin Pirnie <me@kpirnie.com>
     * @package The Cache Purger
     *
    */
    trait VARNISH {

        /** 
         * purge_varnish_caches
         * 
         * This method attempts to delete the varnish based caches
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @param string $_url The url to purge from the cache, if it is empty, all urls will be purged
         * 
         * @return void This method does not return anything
         * 
        */
        private function purge_varnish_caches( ) : void {

            // throw a hook here
            do_action( 'tcp_pre_varnish_purge' );

            // get our URL list
            $_urls = KPCPC::get_urls( );

            // get the remote URL's headers only
            $_res = wp_get_http_headers( site_url( ) );

            // default the is_cf flag and headers
            $_is_cf = false;
            $_headers = array( );

            // if we got a valid response
            if ( $_res && ! is_wp_error( $_res ) ) {

                // cast to array same way pagespeed.php does — WP returns a
                // Requests_Utility_CaseInsensitiveDictionary, not a plain array
                $_headers = array_values( ( array ) $_res );

                // now we have headers, safe to check for cloudflare
                $_is_cf = ( isset( $_headers[0]['server'] ) && ( strpos( $_headers[0]['server'], 'cloudflare' ) !== false ) );

            }

            // get the server IP — only needed if cloudflare, but grab it regardless
            $_server_ip = filter_var( $_SERVER['SERVER_ADDR'] ?? '', FILTER_VALIDATE_IP );

            // let's get the home page URL
            $_hp = get_home_url( );

            // parse it
            $_p_hp = wp_parse_url( $_hp );

            // hold our default request arguments
            $_args = array(
                'method' => 'PURGE',
                'redirection' => 0,
                'header' => array(
                    'host' => $_p_hp['host'],
                    'X-Purge-Method' => 'default'
                ),
            );

            // make sure we have some returned
            if( $_urls ) {

                // loop them
                foreach( $_urls as $_url ) {

                    // if it is run through cloudflare
                    if( $_is_cf ) {

                        // parse the url
                        $_link = wp_parse_url( $_url );

                        // rebuild the URL using the actual server IP
                        $_url = $_link['scheme'] . '://' . $_server_ip . $_link['path'];

                        // set some more arguments
                        $_args['redirection'] = 5; // -L
                        $_args['sslverify'] = false; // -k

                    }

                    // make the remote PURGE request
                    wp_remote_request( $_url, $_args );

                }

            }

            // log the purge
            KPCPC::write_log( "\t\tVARNISH PURGE" );

            // throw a hook here
            do_action( 'tcp_post_varnish_purge' );

        }
        
    }

}

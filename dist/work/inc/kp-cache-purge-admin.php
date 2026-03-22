<?php
/** 
 * Cache Purger Admin
 * 
 * This file contains cache purging settings and admin pages
 * 
 * @since 8.1
 * @author Kevin Pirnie <me@kpirnie.com>
 * @package The Cache Purger
 * 
*/

// We don't want to allow direct access to this
defined( 'ABSPATH' ) || die( 'No direct script access allowed' );

// check if this class already exists
if( ! class_exists( 'KP_Cache_Purge_Admin' ) ) {

    /** 
     * Class KP_Cache_Purge_Admin
     * 
     * Class for building out our settings and admin pages
     * 
     * @since 8.1
     * @access public
     * @author Kevin Pirnie <me@kpirnie.com>
     * @package The Cache Purger
     *  
    */
    class KP_Cache_Purge_Admin {

        /**
         * @var \KP\WPFieldFramework\Framework|null $fw The field framework instance
         */
        protected ?\KP\WPFieldFramework\Framework $fw = null;
        /**
         * @var array $tabs An array to hold the tabs for the settings page
         */
        protected array $tabs = array();
        /**
         * @var object $opts An object to hold the current settings
         */
        protected ?object $opts = null;

        /**
         * Class constructor
         * 
         * Setup the object
         * 
         * @internal
         */
        public function __construct()
        {

            // load our field framework
            $this->fw = \KP\WPFieldFramework\Loader::init();
            // hold our options
            $this->opts = KPCPC::get_options( );
            // add our tabs
            $this->tabs = $this->add_tabs();
        }

        /** 
         * kpcp_admin
         * 
         * Public method pull together the settings and admin pages
         * 
         * @since 8.1
         * @access public
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return void This method does not return anything
         * 
        */
        public function kpcp_admin( ) : void {

            // hold the options key
            $opts_key = 'kpcp_settings';

            // add the main options page
            $options = $this->fw->addOptionsPage( [
                'option_key'         => $opts_key,
                'page_title'         => __('The Cache Purger', 'the-cache-purger'),
                'menu_title'         => __('Cache Purger', 'the-cache-purger'),
                'menu_slug'          => $opts_key,
                'icon_url'           => 'dashicons-layout',
                'position'           => 99,
                'tabs'               => $this->tabs,
                'save_button'        => __('Save Your Settings', 'the-cache-purger'),
                'show_export_import' => true,
                'autoload'           => false, // false, true, null
                'tab_layout'         => 'vertical',
                'footer_text'        => __( 'Thank you for using The Cache Purger!<br /><a href="https://kevinpirnie.com/" target="_blank">Visit our Website</a>', 'the-cache-purger' ),
            ] );

            // register the options page
            $options->register();

            // add in the sub menu items linking to the tabs
            add_submenu_page( 'kpcp_settings', '', __('API/Server Settings', 'the-cache-purger'), 'manage_options', 'admin.php?page=kpcp_settings&tab=api', '' );
            add_submenu_page( 'kpcp_settings', '', __('CRON Settings', 'the-cache-purger'), 'manage_options', 'admin.php?page=kpcp_settings&tab=cron', '' );
            // only if we need them
            if( filter_var( ( $this->opts -> should_log ) ?? false, FILTER_VALIDATE_BOOLEAN ) ) {
                add_submenu_page( 'kpcp_settings', '', __('Purge Log', 'the-cache-purger'), 'manage_options', 'admin.php?page=kpcp_settings&tab=log', '' );
            }
            add_submenu_page( 'kpcp_settings', '', __('Documentation', 'the-cache-purger'), 'manage_options', 'admin.php?page=kpcp_settings&tab=docs', '' );

            // bold the tab in the submenu
            add_filter( 'submenu_file', function( $submenu_file ) {
                $page = sanitize_key( $_GET['page'] ?? '' );
                $tab  = sanitize_key( $_GET['tab']  ?? '' );

                if ( $page === 'kpcp_settings' && $tab !== '' ) {
                    $submenu_file = 'admin.php?page=kpcp_settings&tab=' . $tab;
                }

                return $submenu_file;
            } );

            // add a button to the admin bar for purging manually
            // for this we'll hook directly into the admin menu bar
            add_action( 'admin_bar_menu', function( $_admin_bar ) : void {

                // only do this if we're NOT in a network admin
                if( ! is_network_admin( ) ) {

                    // setup the querys
                    $cache_purge_uri = wp_nonce_url( add_query_arg( 'the_cache_purge', 'true' ), 'tcp_cache_purge' );
                    $log_purge_uri = wp_nonce_url( add_query_arg( 'the_log_purge', 'true', admin_url( 'admin.php?page=kpcp_settings&tab=log' ) ), 'tcp_log_purge' );

                    // setup the rest of the args for the main item
                    $_args = array(
                        'id'    => 'tcpmp',
                        'title' => '<span class="ab-icon dashicons-layout"></span> ' . __( 'Cache Purger', 'the-cache-purger' ),
                        'href'  => false,
                        'meta'  => array( 'title' => __( 'Cache Purger', 'the-cache-purger' ) ),
                    );

                    // add the main node
                    $_admin_bar -> add_node( $_args );

                    // add the main purge as a child node
                    $_admin_bar -> add_node( array(
                        'id'     => 'tcpmp-purge',
                        'parent' => 'tcpmp',
                        'title'  => __( 'Purge the Cache', 'the-cache-purger' ),
                        'href'   => $cache_purge_uri,
                        'meta'   => array( 'title' => __( 'Click here to purge all of your caches.', 'the-cache-purger' ) ),
                    ) );

                    // if we are indeed logging, add the child node to purge it
                    if( filter_var( ( $this->opts -> should_log ) ?? false, FILTER_VALIDATE_BOOLEAN ) ) {
                        $_admin_bar -> add_node( array(
                            'id'     => 'tcpmp-log',
                            'parent' => 'tcpmp',
                            'title'  => __( 'Purge the Log', 'the-cache-purger' ),
                            'href'   => $log_purge_uri,
                            'meta'   => array( 'title' => __( 'View the cache purge log.', 'the-cache-purger' ) ),
                        ) );

                    }

                }

            }, PHP_INT_MAX );

        }

        /** 
         * kpcp_cron_settings
         * 
         * Private method pull together the cronex settings fields
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns an array representing the settings fields
         * 
        */
        private function kpcp_cron_settings( ) : array {

            // get our options
            $_opts = KPCPC::get_options( );

            // extra fields
            $_extras = array( );

            // check the settings to see if we're actually logging
            if( filter_var( ( $_opts -> should_log ) ?? false, FILTER_VALIDATE_BOOLEAN ) ) {

                // log purge allowed?
                $_extras[] = array(
                    'id' => 'cron_log_purge_allowed',
                    'type' => 'switch',
                    'label' => __( 'Purge the log?', 'the-cache-purger' ),
                    'description' => __( 'Do you want to allow scheduled log purges?', 'the-cache-purger' ),
                    'default' => false,
                );

                // existing schedules
                $_extras[] = array(
                    'id' => 'cron_log_purge_schedule',
                    'type' => 'select',
                    'label' => __( 'Purge Schedule', 'the-cache-purger' ),
                    'description' => __( 'Select a purge schedule to use.', 'the-cache-purger' ),
                    'options' => $this -> get_current_schedules( ),
                    'conditional' => [
                        'field' => 'cron_log_purge_allowed',
                        'value' => true,
                        'condition' => '==',
                    ],
                );

            }

            // hold the returnable array
            $_ret = array(

                // allowed?
                array(
                    'id' => 'cron_schedule_allowed',
                    'type' => 'switch',
                    'label' => __( 'Scheduled your Purges?', 'the-cache-purger' ),
                    'description' => __( 'Do you want schedule cache purges?', 'the-cache-purger' ),
                    'default' => false,
                ),

                // existing schedules
                array(
                    'id' => 'cron_schedule_builtin',
                    'type' => 'select',
                    'label' => __( 'Purge Schedule', 'the-cache-purger' ),
                    'description' => __( 'Select a purge schedule to use.', 'the-cache-purger' ),
                    'options' => $this -> get_current_schedules( ),
                    'conditional' => [
                        'field' => 'cron_schedule_allowed',
                        'value' => true,
                        'condition' => '==',
                    ],
                ),

            );

            // let's add in the extra fields
            $_ret = array_merge( $_ret, $_extras );

            // return it
            return $_ret;

        }

        /** 
         * kpcp_apiserver_settings
         * 
         * Private method pull together the api/server settings fields
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns an array representing the settings fields
         * 
        */
        private function kpcp_apiserver_settings( ) : array {

            // hold the returnable array
            $_ret = array(

                // remote redis
                array(
                    'id' => 'remote_redis',
                    'type' => 'switch',
                    'label' => __( 'Remote Redis server?', 'the-cache-purger' ),
                    'description' => __( 'Please only switch this on if you utilize Redis Servers.', 'the-cache-purger' ),
                    'default' => false,
                ),

                // remote redis servers
                array(
                    'id' => 'remote_redis_servers',
                    'type' => 'repeater',
                    'label' => __( 'Redis Servers', 'the-cache-purger' ),
                    'min_rows'     => 1,
                    'max_rows'     => 10,
                    'collapsed'    => true,
                    'sortable'     => true,
                    'button_label' => __( 'Add New Server', 'the-cache-purger' ),
                    'conditional' => [
                        'field' => 'remote_redis',
                        'value' => true,
                        'condition' => '==',
                    ],
                    'fields' => array(

                        // redis server
                        array(
                            'id' => 'remote_redis_server',
                            'label' => __( 'Server', 'the-cache-purger' ),
                            'type' => 'text',
                            'inline' => true,
                            'description' => __( 'Enter the IP address of the server.', 'the-cache-purger' ),
                        ),

                        // redis port
                        array(
                            'id' => 'remote_redis_port',
                            'label' => __( 'Port', 'the-cache-purger' ),
                            'type' => 'text',
                            'inline' => true,
                            'description' => __( 'Enter the Port number of the server.', 'the-cache-purger' ),
                        ),
                        ['id' => 'sep1', 'type' => 'html', 'content' => '<div style="height:0;flex-basis:100%;"></div>' ],

                        // auth username
                        array(
                            'id' => 'remote_redis_auth_user',
                            'label' => __( 'Username', 'the-cache-purger' ),
                            'type' => 'text',
                            'inline' => true,
                            'description' => __( 'Enter your redis username', 'the-cache-purger' ),
                        ),
                        // auth password
                        array(
                            'id' => 'remote_redis_auth_pass',
                            'label' => __( 'Password', 'the-cache-purger' ),
                            'type' => 'password',
                            'inline' => true,
                            'description' => __( 'Enter your redis password', 'the-cache-purger' ),
                        ),
                        ['id' => 'sep2', 'type' => 'html', 'content' => '<div style="height:0;flex-basis:100%;"></div>' ],

                        // database id
                        array(
                            'id' => 'remote_redis_db_id',
                            'label' => __( 'Database ID', 'the-cache-purger' ),
                            'type' => 'text',
                            'inline' => true,
                            'description' => __( 'Enter your database ID', 'the-cache-purger' ),
                        ),

                        // prefix or key
                        array(
                            'id' => 'remote_redis_prefixkey',
                            'label' => __( 'Prefix/Key', 'the-cache-purger' ),
                            'type' => 'text',
                            'inline' => true,
                            'description' => __( 'Enter your prefix/key', 'the-cache-purger' ),
                        ),

                    ),
                ),

                // remote memcache
                array(
                    'id' => 'remote_memcache',
                    'type' => 'switch',
                    'label' => __( 'Remote Memcache server?', 'the-cache-purger' ),
                    'description' => __( 'Please only switch this on if you utilize Memcache Servers.', 'the-cache-purger' ),
                    'default' => false,
                ),
                
                // remote memcache servers
                array(
                    'id' => 'remote_memcache_servers',
                    'type' => 'repeater',
                    'title' => __( 'Memcache Servers', 'the-cache-purger' ),
                    'min_rows'     => 1,
                    'max_rows'     => 10,
                    'collapsed'    => true,
                    'sortable'     => true,
                    'button_label' => __( 'Add New Server', 'the-cache-purger' ),
                    'conditional' => [
                        'field' => 'remote_memcache',
                        'value' => true,
                        'condition' => '==',
                    ],
                    'fields' => array(

                        // memcache server
                        array(
                            'id' => 'remote_memcache_server',
                            'label' => __( 'Server', 'the-cache-purger' ),
                            'type' => 'text',
                            'inline' => true,
                            'description' => __( 'Enter the IP address of the server.', 'the-cache-purger' ),
                        ),

                        // memcache port
                        array(
                            'id' => 'remote_memcache_port',
                            'label' => __( 'Port', 'the-cache-purger' ),
                            'type' => 'text',
                            'inline' => true,
                            'description' => __( 'Enter the Port number of the server.', 'the-cache-purger' ),
                        ),
                    ),
                ),

                // remote memcached
                array(
                    'id' => 'remote_memcached',
                    'type' => 'switch',
                    'label' => __( 'Remote Memcached server?', 'the-cache-purger' ),
                    'description' => __( 'Please only switch this on if you utilize Memcached Servers.', 'the-cache-purger' ),
                    'default' => false,
                ),
                
                // remote memcached servers
                array(
                    'id' => 'remote_memcached_servers',
                    'type' => 'repeater',
                    'label' => __( 'Memcached Servers', 'the-cache-purger' ),
                    'min_rows'     => 1,
                    'max_rows'     => 10,
                    'collapsed'    => true,
                    'sortable'     => true,
                    'button_label' => __( 'Add New Server', 'the-cache-purger' ),
                    'conditional' => [
                        'field' => 'remote_memcached',
                        'value' => true,
                        'condition' => '==',
                    ],
                    'fields' => array(

                        // memcached server
                        array(
                            'id' => 'remote_memcached_server',
                            'label' => __( 'Server', 'the-cache-purger' ),
                            'type' => 'text',
                            'inline' => true,
                            'description' => __( 'Enter the IP address of the server.', 'the-cache-purger' ),
                        ),

                        // memcached port
                        array(
                            'id' => 'remote_memcached_port',
                            'label' => __( 'Port', 'the-cache-purger' ),
                            'type' => 'text',
                            'inline' => true,
                            'description' => __( 'Enter the Port number of the server.', 'the-cache-purger' ),
                        ),
                    ),
                ),
                
                // api keys
                array(
                    'id' => 'service_api_keys',
                    'type' => 'group',
                    'label' => __( 'Service API Keys', 'the-cache-purger' ),
                    'description' => __( 'These are all optional, and only necessary if you do not have the service\'s plugin installed on your site, but their caches are still used.<br /><br />Please consult with your hosting provider or IT Team if you do not know if they are in use.', 'the-cache-purger' ),
                    'fields' => array(
                        
                        // cloudflare Token
                        array(
                            'id' => 'cloudflare_token',
                            'type' => 'password',
                            'label' => __( 'Cloudflare Token', 'the-cache-purger' ),
                            'description' => __( 'Enter your Cloudflare API Token. If you do not have one, you can create one here: <a href="https://dash.cloudflare.com/profile/api-tokens" target="_blank">https://dash.cloudflare.com/profile/api-tokens</a><br /><strong>NOTE: </strong>This is stored in plain-text.', 'the-cache-purger' ),
                            'inline' => true,
                        ),

                        // cloudflare Zone
                        array(
                            'id' => 'cloudflare_zone',
                            'type' => 'password',
                            'label' => __( 'Cloudflare Zone', 'the-cache-purger' ),
                            'description' => __( 'Enter your Cloudflare Zone ID. You can find this by clicking into your websites overview in your account: <a href="https://dash.cloudflare.com/" target="_blank">https://dash.cloudflare.com/</a><br /><strong>NOTE: </strong>This is stored in plain-text.', 'the-cache-purger' ),
                            'inline' => true,
                        ),
                        ['id' => 'sep1', 'type' => 'html', 'content' => '<div style="height:0;flex-basis:100%;"></div>' ],

                        // Sucuri Key
                        array(
                            'id' => 'sucuri_key',
                            'type' => 'password',
                            'label' => __( 'Sucuri Key', 'the-cache-purger' ),
                            'description' => __( 'Enter your Sucuri API Key. If you do not have one, you can find it in your site\'s Firewall here: <a href="https://waf.sucuri.net/" target="_blank">https://waf.sucuri.net/</a>. Click into your site, then Settings, then API.<br /><strong>NOTE: </strong>This is stored in plain-text.', 'the-cache-purger' ),
                            'inline' => true,
                        ),

                        // Sucuri Secret
                        array(
                            'id' => 'sucuri_secret',
                            'type' => 'password',
                            'label' => __( 'Sucuri Secret', 'the-cache-purger' ),
                            'description' => __( 'Enter your Sucuri API Secret. If you do not have one, you can find it in your site\'s Firewall here: <a href="https://waf.sucuri.net/" target="_blank">https://waf.sucuri.net/</a>. Click into your site, then Settings, then API.<br /><strong>NOTE: </strong>This is stored in plain-text.', 'the-cache-purger' ),
                            'inline' => true,
                        ),
                        ['id' => 'sep2', 'type' => 'html', 'content' => '<div style="height:0;flex-basis:100%;"></div>' ],

                        // fastly token
                        array(
                            'id' => 'fastly_token',
                            'type' => 'password',
                            'label' => __( 'Fastly Token', 'the-cache-purger' ),
                            'description' => __( 'Enter your Fastly CDN Token. If you do not have one, you can find it in your account here: <a href="https://manage.fastly.com/account/personal/tokens" target="_blank">https://manage.fastly.com/account/personal/tokens</a>. You will need to make sure to select a service when you create your token.<br /><strong>NOTE: </strong>This is stored in plain-text.', 'the-cache-purger' ),
                            'inline' => true,
                        ),

                        // Service ID
                        array(
                            'id' => 'fastly_service_id',
                            'type' => 'password',
                            'label' => __( 'Fastly Service ID', 'the-cache-purger' ),
                            'description' => __( 'Enter your Fastly Service ID. If you do not have one, you can find it in your account here: <a href="https://manage.fastly.com/account/tokens" target="_blank">https://manage.fastly.com/account/tokens</a>. You will need to make sure to select a service when you create your token.<br /><strong>NOTE: </strong>This is stored in plain-text.', 'the-cache-purger' ),
                            'inline' => true,
                        ),

                    ),
                ),

            );

            // return 
            return $_ret;

        }

        /** 
         * kpcp_settings
         * 
         * Private method pull together the settings fields
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns an array representing the settings fields
         * 
        */
        private function kpcp_settings( ) : array {

            // hold the returnable array
            $_ret = array( );

            // hold the temp array
            $_tmp = array( );

            // return the array of fields
            $_ret = array(

                // cache types to purge
                array(
                    'id' => 'caches_to_purge',
                    'label' => __( 'Caches To Purge', 'the-cache-purger' ),
                    'description' => __( 'Select which caches should be purged?', 'the-cache-purger' ),
                    'type' => 'checkboxes',
                    'options' => array(
                        1 => __( 'Plugin Caches', 'the-cache-purger' ),
                        2 => __( 'Wordpress Caches', 'the-cache-purger' ),
                        3 => __( 'Server Caches', 'the-cache-purger' ),
                        4 => __( 'Memory Caches', 'the-cache-purger' ),
                        5 => __( 'API Caches', 'the-cache-purger' ),
                    ),
                    'inline' => true,
                    'default' => array( '1', '2', '3', '4' ),
                ),

                // log the purge actions
                array(
                    'id' => 'should_log',
                    'type' => 'switch',
                    'label' => __( 'Log Purge Actions?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to write a log of all purge actions performed.<br />The file location is: <code>' . ABSPATH . 'wp-content/purge.log</code><br /><strong>NOTE: </strong>Make sure you hard refresh this page once you save the settings.', 'the-cache-purger' ),
                    'default' => false,
                ),

                // purge on plugin settings
                array(
                    'id' => 'on_plugin_settings',
                    'type' => 'switch',
                    'label' => __( 'Purge on settings save?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to purge all configured caches for settings save actions.<br /><strong>NOTE:</strong>You need to hard refresh this page after saving this setting in order for this to take effect.', 'the-cache-purger' ),
                    'default' => false,
                ),

                // purge on menu
                array(
                    'id' => 'on_menu',
                    'type' => 'switch',
                    'label' => __( 'Purge on Menu Save/Delete?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to purge all configured caches for every menu update, save, or delete.', 'the-cache-purger' ),
                    'default' => false,
                ),
                
                // purge on post
                array(
                    'id' => 'on_post',
                    'type' => 'switch',
                    'label' => __( 'Purge on Post Save/Delete?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to purge all configured caches for every post update, save, or delete.', 'the-cache-purger' ),
                    'default' => false,
                ),

                // post exclusions
                array(
                    'id' => 'on_post_exclude',
                    'type' => 'multiselect',
                    'label' => __( 'Ignored Posts', 'the-cache-purger' ),
                    'sublabel' => __( 'select the posts to ignore...', 'the-cache-purger' ),
                    'description' => __( 'Posts to ignore from the purger. This will simply ignore the purge action when the selected posts get updated.', 'the-cache-purger' ),
                    'options' => KPCPC::get_posts_for_select( 'posts' ),
                    'default' => array( '0' ),
                    'conditional' => [
                        'field' => 'on_post',
                        'value' => true,
                        'condition' => '==',
                    ],                    
                ),

                // purge on page
                array(
                    'id' => 'on_page',
                    'type' => 'switch',
                    'label' => __( 'Purge on Page Save/Delete?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to purge all configured caches for every page update, save, or delete.', 'the-cache-purger' ),
                    'default' => false,
                ),

                // page exclusions
                array(
                    'id' => 'on_page_exclude',
                    'type' => 'multiselect',
                    'label' => __( 'Ignored Pages', 'the-cache-purger' ),
                    'sublabel' => __( 'select the pages to ignore...', 'the-cache-purger' ),
                    'description' => __( 'Pages to ignore from the purger. This will simply ignore the purge action when the selected pages get updated.', 'the-cache-purger' ),
                    'options' => KPCPC::get_posts_for_select( 'pages' ),
                    'default' => array( '0' ),
                    'conditional' => [
                        'field' => 'on_page',
                        'value' => true,
                        'condition' => '==',
                    ],                    
                ),

                // purge on CPT
                array(
                    'id' => 'on_cpt',
                    'type' => 'switch',
                    'label' => __( 'Purge on Custom Post Type Save/Delete?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to purge all configured caches for every custom post type update, save, or delete.', 'the-cache-purger' ),
                    'default' => false,
                ),

                // cpt exclusions
                array(
                    'id' => 'on_cpt_exclude',
                    'type' => 'multiselect',
                    'label' => __( 'Ignored CPTs', 'the-cache-purger' ),
                    'sublabel' => __( 'select the cpts to ignore...', 'the-cache-purger' ),
                    'description' => __( 'CPTs to ignore from the purger. This will simply ignore the purge action when the selected CPT get updated.', 'the-cache-purger' ),
                    'options' => KPCPC::get_post_types_for_select( ),
                    'default' => array( '0' ),
                    'conditional' => [
                        'field' => 'on_cpt',
                        'value' => true,
                        'condition' => '==',
                    ],                    
                ),

                // purge on taxonomy
                array(
                    'id' => 'on_taxonomy',
                    'type' => 'switch',
                    'label' => __( 'Purge on Taxonomy/Term Save/Delete?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to purge all configured caches for every taxonomy/term update, save, or delete.', 'the-cache-purger' ),
                    'default' => false,
                ),

                // purge on category
                array(
                    'id' => 'on_category',
                    'type' => 'switch',
                    'label' => __( 'Purge on Category Save/Delete?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to purge all configured caches for every category update, save, or delete.', 'the-cache-purger' ),
                    'default' => false,
                ),

                // purge on widget
                array(
                    'id' => 'on_widget',
                    'type' => 'switch',
                    'label' => __( 'Purge on Widget Save/Delete?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to purge all configured caches for every widget update, save, or delete.', 'the-cache-purger' ),
                    'default' => false,
                ),

                // purge on customizer
                array(
                    'id' => 'on_customizer',
                    'type' => 'switch',
                    'label' => __( 'Purge on Customizer Save?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to purge all configured caches for every customizer update or save.', 'the-cache-purger' ),
                    'default' => false,
                ),
                
            );

            // if gravity forms is installed and activated
            if( class_exists( 'GFAPI' ) ) {

                // purge on form field
                $_tmp[] = array(
                        'id' => 'on_form',
                        'type' => 'switch',
                        'label' => __( 'Purge on Form Save/Delete?', 'the-cache-purger' ),
                        'description' => __( 'This will attempt to purge all configured caches for every form update, save, or delete.', 'the-cache-purger' ),
                        'default' => false,
                    );

                // for exclusions
                $_tmp[] = array(
                    'id' => 'on_form_exclude',
                    'type' => 'multiselect',
                    'label' => __( 'Ignored Forms', 'the-cache-purger' ),
                    'sublabel' => __( 'select the forms to ignore...', 'the-cache-purger' ),
                    'description' => __( 'Forms to ignore from the purger. This will simply ignore the purge action when the selected forms get updated.', 'the-cache-purger' ),
                    'options' => $this -> get_our_forms( ),
                    'default' => array( '0' ),
                    'conditional' => [
                        'field' => 'on_form',
                        'value' => true,
                        'condition' => '==',
                    ],                    
                );

            }

            // if ACF is installed and activated
            if( class_exists('ACF') ) {

                // purge on form field
                $_tmp[] = array(
                    'id' => 'on_acf',
                    'type' => 'switch',
                    'label' => __( 'Purge on ACF Save/Delete?', 'the-cache-purger' ),
                    'description' => __( 'This will attempt to purge all configured caches for every "advanced custom field" group update, save, or delete.', 'the-cache-purger' ),
                    'default' => false,
                );
 
                // for exclusions
                $_tmp[] = array(
                    'id' => 'on_acf_exclude',
                    'type' => 'multiselect',
                    'label' => __( 'Ignored Field Groups', 'the-cache-purger' ),
                    'sublabel' => __( 'select the field groupd to ignore...', 'the-cache-purger' ),
                    'description' => __( 'Field Groups to ignore from the purger. This will simply ignore the purge action when the selected field groups get updated.', 'the-cache-purger' ),
                    'options' => $this -> get_our_field_groups( ),
                    'default' => array( '0' ),
                    'conditional' => [
                        'field' => 'on_acf',
                        'value' => true,
                        'condition' => '==',
                    ],                    
                );

            }

            // return the merged arrays
            return array_merge( $_ret, $_tmp );

        }

        /** 
         * kpcp_docs
         * 
         * Private method pull together the documentation
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return string Returns the string content of the documentation file
         * 
        */
        private function kpcp_docs( ) : string {

            // hold the return
            $_ret = '';

            // setup the path
            $_path = TCP_PATH . "/work/doc.php";

            // if the file exists
            if( file_exists( $_path ) && is_readable( $_path ) ) {

                // start the output buffer
                ob_start( );
                
                // include the doc file
                include $_path;
                
                // include the documentation
                $_ret = ob_get_contents();
                
                // clean and end the output buffer
                ob_end_clean( );

            }

            // return it
            return $_ret;

        }

        /** 
         * kpcp_purge_log
         * 
         * Private method pull in the purge log for display in the backend
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return string Returns the string content of the purge log
         * 
        */
        private function kpcp_purge_log( ) : string {

            // hold the return
            $_ret = '';

            // setup the path
            $_path = ABSPATH . 'wp-content/purge.log';

            // see if we're purging the log before displaying it
            $_do_log_purge = filter_var( ( isset( $_GET['the_log_purge'] ) ) ? sanitize_text_field( $_GET['the_log_purge'] ) : false, FILTER_VALIDATE_BOOLEAN );
            if( $_do_log_purge && current_user_can( 'manage_options' ) && wp_verify_nonce( sanitize_text_field( $_GET['_wpnonce'] ?? '' ), 'tcp_log_purge' ) ) {
                file_put_contents( $_path, '', LOCK_EX );
            }

            // if the file exists
            if( file_exists( $_path ) && is_readable( $_path ) ) {

                // start the output buffer
                ob_start( );
                
                // include the doc file
                include $_path;
                
                // include the documentation
                $_ret = ob_get_contents();
                
                // clean and end the output buffer
                ob_end_clean( );

            }
            
            // if the log is actually empty
            if(empty($_ret)) {
                $_ret =  __('The log is currently empty...', 'the-cache-purger');
            }

            // return it
            return sprintf('<pre>%s</pre>', $_ret);

        }

        /** 
         * add_tabs
         * 
         * Private method to build the tabs array for the settings page
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns an array of tabs
         * 
        */
        private function add_tabs(): array
        {

            // build the tabs array
            $ret = [
                'general' => $this->build_general_tab(),
                'api'     => $this->build_api_tab(),
                'cron'    => $this->build_cron_tab(),
                'log'     => $this->build_log_tab(),
                'docs'    => $this->build_docs_tab(),
            ];

            // if we don't need the log tab, remove it
            if( ! filter_var( ( $this->opts->should_log ) ?? false, FILTER_VALIDATE_BOOLEAN ) ) {
                unset( $ret['log'] );
            }

            // return the tabs
            return $ret;

        }

        /** 
         * build_general_tab
         * 
         * Private method to build the general settings tab
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns the general tab configuration array
         * 
        */
        private function build_general_tab(): array
        {

            // return the tab configuration
            return [
                'title'    => __( 'General Settings', 'the-cache-purger' ),
                'sections' => [
                    'a' => [ 'fields' => $this->kpcp_settings() ],
                ],
            ];

        }

        /** 
         * build_api_tab
         * 
         * Private method to build the API/Server settings tab
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns the API/Server tab configuration array
         * 
        */
        private function build_api_tab(): array
        {

            // return the tab configuration
            return [
                'title'    => __( 'API/Server Settings', 'the-cache-purger' ),
                'sections' => [
                    'b' => [ 'fields' => $this->kpcp_apiserver_settings() ],
                ],
            ];

        }

        /** 
         * build_cron_tab
         * 
         * Private method to build the CRON settings tab
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns the CRON tab configuration array
         * 
        */
        private function build_cron_tab(): array
        {

            // return the tab configuration
            return [
                'title'    => __( 'CRON Settings', 'the-cache-purger' ),
                'sections' => [
                    'c' => [ 'fields' => $this->kpcp_cron_settings() ],
                ],
            ];

        }

        /** 
         * build_log_tab
         * 
         * Private method to build the purge log tab
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns the log tab configuration array
         * 
        */
        private function build_log_tab(): array
        {

            // return the tab configuration
            return [
                'title'            => __( 'Purge Log', 'the-cache-purger' ),
                'hide_save_button' => true,
                'sections'         => [
                    'd' => [
                        'fields' => [
                            [
                                'id'      => 'kptcp_log',
                                'type'    => 'html',
                                'content' => $this->kpcp_purge_log(),
                            ],
                        ],
                    ],
                ],
                'buttons' => [
                    [
                        'label'      => __( 'Refresh the Log', 'the-cache-purger' ),
                        'type'       => 'button',
                        'class'      => 'button button-primary',
                        'id'         => 'kptcp-refresh-log',
                        'attributes' => [
                            'onclick' => 'window.location="' . admin_url( 'admin.php?page=kpcp_settings&tab=log' ) . '"; return false;',
                        ],
                    ],
                    [
                        'label'  => __( 'Clear the Log', 'the-cache-purger' ),
                        'type'   => 'button',
                        'id'     => 'kptcp-clear-log',
                        'class'  => 'button button-secondary',
                        'attributes' => [
                            'onclick' => 'window.location="' . wp_nonce_url( add_query_arg( 'the_log_purge', 'true', admin_url( 'admin.php?page=kpcp_settings&tab=log' ) ), 'tcp_log_purge' ) . '"; return false;',
                        ],
                    ],
                ],
            ];

        }

        /** 
         * build_docs_tab
         * 
         * Private method to build the documentation tab
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns the documentation tab configuration array
         * 
        */
        private function build_docs_tab(): array
        {

            // return the tab configuration
            return [
                'title'            => __( 'Documentation', 'the-cache-purger' ),
                'hide_save_button' => true,
                'sections'         => [
                    'e' => [
                        'fields' => [
                            [
                                'id'      => 'kptcp_docs',
                                'type'    => 'html',
                                'content' => $this->kpcp_docs(),
                            ],
                        ],
                    ],
                ],
            ];

        }
    
        /** 
         * get_forms
         * 
         * Private method pull all forms
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns an array representing the forms created for the site
         * 
        */
        private function get_our_forms( ) : array {

            // setup a returnable array
            $_ret = array( );

            // populate the NONE
            $_ret[0] = __( ' -- None -- ', 'the-cache-purger' );

            // get all forms
            $_forms = GFAPI::get_forms( );

            // if there are some
            if( $_forms ) {

                // get a count
                $_fCt = count( $_forms );

                // loop over them
                for( $_i = 0; $_i < $_fCt; ++$_i ) {

                    // setup the return array
                    $_ret[$_forms[$_i]['id']] = __( $_forms[$_i]['title'], 'the-cache-purger' );

                }

            }

            // return
            return $_ret;

        }

        /** 
         * get_field_groups
         * 
         * Private method pull all ACF field groups
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns an array representing the field groups created for the site
         * 
        */
        private function get_our_field_groups( ) : array {

            // setup a returnable array
            $_ret = array( );

            // populate the NONE
            $_ret[0] = __( ' -- None -- ', 'the-cache-purger' );

            // get all field groups
            $_fgs = acf_get_field_groups( );

            // make sure we have a return
            if( $_fgs ) {

                // get a count
                $_fCt = count( $_fgs );

                // loop over them
                for( $_i = 0; $_i < $_fCt; ++$_i ) {

                    // add to the array
                    $_ret[$_fgs[$_i]['ID']] = __( $_fgs[$_i]['title'], 'the-cache-purger' );

                }

            }

            // return
            return $_ret;

        }

        /** 
         * get_current_schedules
         * 
         * The method pulls the current WP Cron schedules
         * 
         * @since 8.1
         * @access private
         * @author Kevin Pirnie <me@kpirnie.com>
         * @package The Cache Purger
         * 
         * @return array Returns an array of the existing WP cron schedules
         * 
        */
        private function get_current_schedules( ) : array {

            // get the schedules
			$_sched = wp_get_schedules( );

			// setup our returnable array
			$_ret = array( );

			// loop over the schedules
			foreach( $_sched as $_k => $_v ) {

				// populate the returnable array
				$_ret[ $_k ] = __( $_v[ 'display' ], 'the-cache-purger' );
			}

			// return the array
			return $_ret;

        }

    }

}

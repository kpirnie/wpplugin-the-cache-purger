<?php
/** 
 * Documentation
 * 
 * The plugin documentation
 * 
 * @since 8.1
 * @author Kevin Pirnie <me@kpirnie.com>
 * @package The Cache Purger
 * 
*/

// We don't want to allow direct access to this
defined( 'ABSPATH' ) || die( 'No direct script access allowed' );

?>

<article class="kptcp-doc-content" id="kpcp_top">
    <header>
        <h1><?php esc_html_e( 'The Cache Purger Documentation', 'the-cache-purger' ); ?></h1>
    </header>
    <main>
        <h2 id="kpcp_desc"><?php esc_html_e( 'Description', 'the-cache-purger' ); ?></h2>
        <p class="kpcp_nav"><a href="#kpcp_top"><?php esc_html_e( 'TOP', 'the-cache-purger' ); ?></a> | <a href="#kpcp_desc"><?php esc_html_e( 'DESCRIPTION', 'the-cache-purger' ); ?></a> | <a href="#kpcp_features"><?php esc_html_e( 'FEATURES', 'the-cache-purger' ); ?></a> | <a href="#kpcp_settings"><?php esc_html_e( 'SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_api_settings"><?php esc_html_e( 'API/SERVER SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_in_the_works"><?php esc_html_e( 'IN THE WORKS', 'the-cache-purger' ); ?></a></p>
        <p><?php esc_html_e( 'This plugin attempts to purge all server-side caching methods', 'the-cache-purger' ); ?>.</p>
        <p><?php esc_html_e( 'This includes the most common caching plugins, some hosting based caches, most server based caches, built-in Wordpress object caches, and even simple file based caches', 'the-cache-purger' ); ?></p>
        <p><?php esc_html_e( 'Just configure what you want to purge on, and the plugin will take care of the rest', 'the-cache-purger' ); ?>.</p>
        <p><?php esc_html_e( 'We have also included a CLI cache purger.  Shell into your install and run the following command:', 'the-cache-purger' ); ?> <code>wp the_cache purge</code>. <?php esc_html_e( 'The normal CLI flags apply, and if you are in a multisite, you must include the --url flag.', 'the-cache-purger' ); ?></p>
        <h2 id="kpcp_features"><?php esc_html_e( 'Features', 'the-cache-purger' ); ?></h2>
        <p class="kpcp_nav"><a href="#kpcp_top"><?php esc_html_e( 'TOP', 'the-cache-purger' ); ?></a> | <a href="#kpcp_desc"><?php esc_html_e( 'DESCRIPTION', 'the-cache-purger' ); ?></a> | <a href="#kpcp_features"><?php esc_html_e( 'FEATURES', 'the-cache-purger' ); ?></a> | <a href="#kpcp_settings"><?php esc_html_e( 'SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_api_settings"><?php esc_html_e( 'API/SERVER SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_in_the_works"><?php esc_html_e( 'IN THE WORKS', 'the-cache-purger' ); ?></a></p>
        <h3><?php esc_html_e( 'Built in automatic cache purging for the following caches', 'the-cache-purger' ); ?></h3>
        <ul>
            <li><strong><?php esc_html_e( 'Plugins/Themes', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Flying Press', 'the-cache-purger' ); ?>, <?php esc_html_e( 'SiteGround Optimizer', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Nginx Helper', 'the-cache-purger' ); ?>, <?php esc_html_e( 'LiteSpeed Cache', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Cachify', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Autoptimize', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Fast Velocity Minify', 'the-cache-purger' ); ?>, <?php esc_html_e( 'WP Rocket', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Swift Performance', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Comet Cache', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Hummingbird', 'the-cache-purger' ); ?>, <?php esc_html_e( 'WP Fastest Cache', 'the-cache-purger' ); ?>, <?php esc_html_e( 'WP Super Cache', 'the-cache-purger' ); ?>, <?php esc_html_e( 'W3 Total Cache', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Hyper Cache', 'the-cache-purger' ); ?>, <?php esc_html_e( 'WP Optimize', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Cache Enabler', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Divi', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Elementor', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li><strong><?php esc_html_e( 'Hosting / CDN', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'WPEngine', 'the-cache-purger' ); ?>, <?php esc_html_e( 'SpinupWP', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Kinsta', 'the-cache-purger' ); ?>, <?php esc_html_e( 'GoDaddy', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Pantheon', 'the-cache-purger' ); ?>, <?php esc_html_e( 'CloudFlare', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Sucuri', 'the-cache-purger' ); ?>, <?php esc_html_e( 'RunCloud', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Siteground', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Bluehost', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Breezeway', 'the-cache-purger' ); ?></li>
                    <li><em><?php esc_html_e( 'Some of these are dependant on separate plugins.  Please see your provider if it is necessary, or already included', 'the-cache-purger' ); ?></em></li>
                </ul>
            </li>
            <li><strong><?php esc_html_e( 'Server Based', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Fastly CDN', 'the-cache-purger' ); ?>, <?php esc_html_e( 'PHP FPM', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Zend Opcache', 'the-cache-purger' ); ?>, <?php esc_html_e( 'APC and APCU', 'the-cache-purger' ); ?>, <?php esc_html_e( 'WinCache', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Pagespeed Module', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Memcache', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Memcached', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Redis', 'the-cache-purger' ); ?>, <?php esc_html_e( 'nGinx', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Static File Caches', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li><strong><?php esc_html_e( 'Wordpress Built-In', 'the-cache-purger' ); ?></strong> <?php esc_html_e( 'object caching and persistent object caching', 'the-cache-purger' ); ?></li>
        </ul>
        
        <h3><?php esc_html_e( 'Purges are configurable in the settings, and include the following saves/updates/trashes:', 'the-cache-purger' ); ?></h3>
        <ul>
            <li><?php esc_html_e( 'Posts', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Pages', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Custom Post Types', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Categories', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Taxonomies', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Widgets', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Menus', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Plugins', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Updates', 'the-cache-purger' ); ?>, <?php esc_html_e( 'Settings & Options', 'the-cache-purger' ); ?>, <?php esc_html_e( 'GravityForms', 'the-cache-purger' ); ?> (<em><?php esc_html_e( 'if installed and activated', 'the-cache-purger' ); ?></em>), <?php esc_html_e( 'Advanced Custom Fields', 'the-cache-purger' ); ?> (<em><?php esc_html_e( 'if installed and activated', 'the-cache-purger' ); ?></em>), <?php esc_html_e( 'WooCommerce Settings', 'the-cache-purger' ); ?> (<em><?php esc_html_e( 'if installed and activated', 'the-cache-purger' ); ?></em>)</li>
        </ul>
        <h2 id="kpcp_settings"><?php esc_html_e( 'Settings', 'the-cache-purger' ); ?></h2>
        <p class="kpcp_nav"><a href="#kpcp_top"><?php esc_html_e( 'TOP', 'the-cache-purger' ); ?></a> | <a href="#kpcp_desc"><?php esc_html_e( 'DESCRIPTION', 'the-cache-purger' ); ?></a> | <a href="#kpcp_features"><?php esc_html_e( 'FEATURES', 'the-cache-purger' ); ?></a> | <a href="#kpcp_settings"><?php esc_html_e( 'SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_api_settings"><?php esc_html_e( 'API/SERVER SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_in_the_works"><?php esc_html_e( 'IN THE WORKS', 'the-cache-purger' ); ?></a></p>
        <ul>
            <li>
                <strong><?php esc_html_e( 'Log Purge Actions?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>should_log</code></li>
                    <li><?php esc_html_e( 'Do you want to log purge actions?  The log file will be located here:', 'the-cache-purger' ); ?> <code><?php esc_html_e( ABSPATH . 'wp-content/purge.log', 'the-cache-purger' ); ?></code></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Purge on Menu?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_menu</code></li>
                    <li><?php esc_html_e( 'This will attempt to purge all caches for every menu update, save, or delete.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Purge on Post?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_post</code></li>
                    <li><?php esc_html_e( 'This will attempt to purge all caches for every post update, save, or delete.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Ignored Posts', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_postesc_html_exclude</code></li>
                    <li><?php esc_html_e( 'Select the posts you wish to ignore from the cache purge actions.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Purge on Page?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_page</code></li>
                    <li><?php esc_html_e( 'This will attempt to purge all caches for every page update, save, or delete.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Ignored Pages', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_pageesc_html_exclude</code></li>
                    <li><?php esc_html_e( 'Select the pages you wish to ignore from the cache purge actions.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Purge on CPT?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_cpt</code></li>
                    <li><?php esc_html_e( 'This will attempt to purge all caches for every custom post type update, save, or delete.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Ignore CPT', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_cptesc_html_exclude</code></li>
                    <li><?php esc_html_e( 'Select the custom post types you wish to ignore from the cache purge actions.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Purge on Term/Taxonomy?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_taxonomy</code></li>
                    <li><?php esc_html_e( 'This will attempt to purge all caches for every taxonomy/term update, save, or delete.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Purge on Category?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_category</code></li>
                    <li><?php esc_html_e( 'This will attempt to purge all caches for every category update, save, or delete.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Purge on Widget?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_widget</code></li>
                    <li><?php esc_html_e( 'This will attempt to purge all caches for every widget update, save, or removal.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Purge on Customizer?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_customizer</code></li>
                    <li><?php esc_html_e( 'This will attempt to purge all caches for every customizer update or save.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Purge on GravityForms?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_form</code></li>
                    <li><?php esc_html_e( 'This will attempt to purge all caches for every form update, save, or delete.', 'the-cache-purger' ); ?></li>
                    <li><em><?php esc_html_e( 'This option is only available if you have GravityForms installed and active on your site.', 'the-cache-purger' ); ?></em></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Ignore Forms', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_formesc_html_exclude</code></li>
                    <li><?php esc_html_e( 'Select the forms you wish to ignore from the cache purge actions.', 'the-cache-purger' ); ?></li>
                    <li><em><?php esc_html_e( 'This option is only available if you have GravityForms installed and active on your site.', 'the-cache-purger' ); ?></em></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Purge on ACF?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_acf</code></li>
                    <li><?php esc_html_e( 'This will attempt to purge all caches for every "advanced custom field" group update, save, or delete.', 'the-cache-purger' ); ?></li>
                    <li><em><?php esc_html_e( 'This option is only available if you have Advanced Custom Fields installed and active on your site.', 'the-cache-purger' ); ?></em></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Ignore Field Group', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>on_acfesc_html_exclude</code></li>
                    <li><?php esc_html_e( 'Select the field groups you wish to ignore from the cache purge actions.', 'the-cache-purger' ); ?></li>
                    <li><em><?php esc_html_e( 'This option is only available if you have Advanced Custom Fields installed and active on your site.', 'the-cache-purger' ); ?></em></li>
                </ul>
            </li>
        </ul>
        <h2 id="kpcp_api_settings"><?php esc_html_e( 'API/SERVER Settings', 'the-cache-purger' ); ?></h2>
        <p class="kpcp_nav"><a href="#kpcp_top"><?php esc_html_e( 'TOP', 'the-cache-purger' ); ?></a> | <a href="#kpcp_desc"><?php esc_html_e( 'DESCRIPTION', 'the-cache-purger' ); ?></a> | <a href="#kpcp_features"><?php esc_html_e( 'FEATURES', 'the-cache-purger' ); ?></a> | <a href="#kpcp_settings"><?php esc_html_e( 'SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_api_settings"><?php esc_html_e( 'API/SERVER SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_in_the_works"><?php esc_html_e( 'IN THE WORKS', 'the-cache-purger' ); ?></a></p>
        <ul>
            <li>
                <strong><?php esc_html_e( 'Remote Redis Server', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>remote_redis</code></li>
                    <li><?php esc_html_e( 'Do you want to configure Redis servers to be purged?', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Redis Servers - Server', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>remote_redis_servers['remote_redis_server']</code></li>
                    <li><?php esc_html_e( 'Insert the servers IP address.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Redis Servers - Port', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>remote_redis_servers['remote_redis_port']</code></li>
                    <li><?php esc_html_e( 'Insert the servers port.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Remote Memcache Server', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>remote_memcache</code></li>
                    <li><?php esc_html_e( 'Do you want to configure Memcache servers to be purged?', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Memcache Servers - Server', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>remote_memcache_servers['remote_memcache_server']</code></li>
                    <li><?php esc_html_e( 'Insert the servers IP address.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Memcache Servers - Port', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>remote_memcache_servers['remote_memcache_port']</code></li>
                    <li><?php esc_html_e( 'Insert the servers port.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Remote Memcached Server', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>remote_memcached</code></li>
                    <li><?php esc_html_e( 'Do you want to configure Memcached servers to be purged?', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Memcached Servers - Server', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>remote_memcached_servers['remote_memcached_server']</code></li>
                    <li><?php esc_html_e( 'Insert the servers IP address.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Memcached Servers - Port', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>remote_memcached_servers['remote_memcached_port']</code></li>
                    <li><?php esc_html_e( 'Insert the servers port.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Service API Keys', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li>
                        <strong><?php esc_html_e( 'Cloudflare Token', 'the-cache-purger' ); ?></strong>
                        <ul>
                            <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>service_api_keys['cloudflare_token']</code></li>
                            <li><?php esc_html_e( 'Enter your Cloudflare API Token. If you do not have one, you can create one here: <a href="https://dash.cloudflare.com/profile/api-tokens" target="_blank">https://dash.cloudflare.com/profile/api-tokens</a><br /><strong>NOTE: </strong>This is stored in plain-text.', 'the-cache-purger' ); ?></li>
                        </ul>
                    </li>
                    <li>
                        <strong><?php esc_html_e( 'Cloudflare Zone', 'the-cache-purger' ); ?></strong>
                        <ul>
                            <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>service_api_keys['cloudflare_zone']</code></li>
                            <li><?php esc_html_e( 'Enter your Cloudflare Zone ID. You can find this by clicking into your websites overview in your account: <a href="https://dash.cloudflare.com/" target="_blank">https://dash.cloudflare.com/</a><br /><strong>NOTE: </strong>This is stored in plain-text.', 'the-cache-purger' ); ?></li>
                        </ul>
                    </li>
                    <li>
                        <strong><?php esc_html_e( 'Sucuri Key', 'the-cache-purger' ); ?></strong>
                        <ul>
                            <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>service_api_keys['sucuri_key']</code></li>
                            <li><?php esc_html_e( 'Enter your Sucuri API Key. If you do not have one, you can find it in your site\'s Firewall here: <a href="https://waf.sucuri.net/" target="_blank">https://waf.sucuri.net/</a>. Click into your site, then Settings, then API.<br /><strong>NOTE: </strong>This is stored in plain-text.', 'the-cache-purger' ); ?></li>
                        </ul>
                    </li>
                    <li>
                        <strong><?php esc_html_e( 'Sucuri Secret', 'the-cache-purger' ); ?></strong>
                        <ul>
                            <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>service_api_keys['sucuri_secret']</code></li>
                            <li><?php esc_html_e( 'Enter your Sucuri API Secret. If you do not have one, you can find it in your site\'s Firewall here: <a href="https://waf.sucuri.net/" target="_blank">https://waf.sucuri.net/</a>. Click into your site, then Settings, then API.<br /><strong>NOTE: </strong>This is stored in plain-text.', 'the-cache-purger' ); ?></li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
        <h2 id="kpcp_cron_settings"><?php esc_html_e( 'CRON Action Settings', 'the-cache-purger' ); ?></h2>
        <p class="kpcp_nav"><a href="#kpcp_top"><?php esc_html_e( 'TOP', 'the-cache-purger' ); ?></a> | <a href="#kpcp_desc"><?php esc_html_e( 'DESCRIPTION', 'the-cache-purger' ); ?></a> | <a href="#kpcp_features"><?php esc_html_e( 'FEATURES', 'the-cache-purger' ); ?></a> | <a href="#kpcp_settings"><?php esc_html_e( 'SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_api_settings"><?php esc_html_e( 'API/SERVER SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_in_the_works"><?php esc_html_e( 'IN THE WORKS', 'the-cache-purger' ); ?></a></p>
        <ul>
            <li>
                <strong><?php esc_html_e( 'Allow Scheduled Purges?', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>cron_schedule_allowed</code></li>
                    <li><?php esc_html_e( 'Should the cached be purged based on a Wordpress Cron schedule?', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
            <li>
                <strong><?php esc_html_e( 'Built-In Schedule', 'the-cache-purger' ); ?></strong>
                <ul>
                    <li><?php esc_html_e( 'Option(s) Name:', 'the-cache-purger' ); ?> <code>cron_schedule_builtin</code></li>
                    <li><?php esc_html_e( 'Select a built-in schedule to purge the caches on.', 'the-cache-purger' ); ?></li>
                </ul>
            </li>
        </ul>
        <h2 id="kpcp_in_the_works"><?php esc_html_e( 'In The Works', 'the-cache-purger' ); ?></h2>
        <p class="kpcp_nav"><a href="#kpcp_top"><?php esc_html_e( 'TOP', 'the-cache-purger' ); ?></a> | <a href="#kpcp_desc"><?php esc_html_e( 'DESCRIPTION', 'the-cache-purger' ); ?></a> | <a href="#kpcp_features"><?php esc_html_e( 'FEATURES', 'the-cache-purger' ); ?></a> | <a href="#kpcp_settings"><?php esc_html_e( 'SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_api_settings"><?php esc_html_e( 'API/SERVER SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_cron_settings"><?php esc_html_e( 'CRON Action SETTINGS', 'the-cache-purger' ); ?></a> | <a href="#kpcp_in_the_works"><?php esc_html_e( 'IN THE WORKS', 'the-cache-purger' ); ?></a></p>
        <ul>
            <li><?php esc_html_e( 'WooCommerce Product Updates (<em>and exclusions</em>)', 'the-cache-purger' ); ?></li>
            <li><?php esc_html_e( 'WooCommerce Order Updates', 'the-cache-purger' ); ?></li>
            <li><?php esc_html_e( 'More Plugin References', 'the-cache-purger' ); ?></li>
            <li><?php esc_html_e( 'More Hosting References', 'the-cache-purger' ); ?></li>
        </ul>
    </main>
    <footer></footer>
</article>

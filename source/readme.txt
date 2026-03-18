=== The Cache Purger ===
Contributors: kevp75
Donate link: https://paypal.me/kevinpirnie
Tags: cache, cache purging, purge cache, caching, performance
Requires at least: 6.0
Tested up to: 7.0
Requires PHP: 8.2
Stable tag: 2.2.78
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Automatically purge every server-side cache on your WordPress site — plugins, hosting environments, PHP, memory stores, and CDNs — all from one place.

== Description ==

**The Cache Purger** takes the headache out of cache management. Instead of juggling a dozen different cache-clearing buttons across your stack, this plugin hooks into WordPress actions and fires them all at once — automatically, on a schedule, or with a single click from the admin bar.

It covers the full spectrum: popular caching plugins, managed hosting environments, PHP-level caches (OPcache, APC, WinCache), server-level caches (Nginx, Varnish, PageSpeed), in-memory stores (Redis, Memcache, Memcached), and external CDN/WAF APIs (Cloudflare, Sucuri, Fastly).

**Every purge is configurable.** Choose which cache types to include, which WordPress events should trigger a purge, and which specific posts, pages, CPTs, or field groups to exclude. You can also run purges on a WP Cron schedule, or kick one off manually via WP-CLI.

= What Gets Purged =

**Caching Plugins**

Flying Press, SiteGround Optimizer, Nginx Helper, LiteSpeed Cache, Cachify, Autoptimize, Fast Velocity Minify, WP Rocket, Swift Performance, Comet Cache, Hummingbird, WP Fastest Cache, WP Super Cache, W3 Total Cache, Hyper Cache, WP-Optimize, Cache Enabler, NitroPack, Divi, Elementor, WP REST Cache, and more.

**Hosting Environments**

WP Engine, Kinsta, GoDaddy Managed WordPress, Pantheon, Bluehost, Cloudways (Breeze), SiteGround, RunCloud, SpinupWP.

Some of these rely on the host's companion plugin being installed. Check with your provider if you're unsure.

**Server & PHP Caches**

Zend OPcache, APC/APCu, WinCache, XCache, Nginx (fastcgi/proxy cache), PageSpeed Module, Varnish, static file caches.

**Memory Stores**

Redis, Memcache, Memcached — with support for remote servers, authentication, per-database flushing, and prefix/key-scoped clearing.

**CDN & WAF APIs**

Cloudflare (full cache purge via API token), Sucuri WAF, Fastly CDN.

**WordPress Built-In**

Object cache, options cache, transients, persistent object cache.

= Purge Triggers =

Configure purges to fire automatically on any combination of the following WordPress events:

* Post save / update / trash
* Page save / update / trash
* Custom Post Type save / update / trash
* Taxonomy / term save / delete
* Category save / delete
* Menu save / delete
* Widget save / delete
* Customizer save
* GravityForms form save / trash *(requires GravityForms)*
* Advanced Custom Fields field group save / trash *(requires ACF)*
* WooCommerce settings save *(requires WooCommerce)*
* Plugin activation / deactivation
* Core / plugin / theme updates
* Plugin settings save *(this plugin's own settings page)*

Exclusion lists are available for posts, pages, CPTs, GravityForms forms, and ACF field groups — so you can carve out anything that shouldn't trigger a purge.

= Additional Features =

* **Admin bar button** — Master Cache Purge available on every admin page, one click from anywhere.
* **Purge log** — Optional logging of every purge action to `wp-content/purge.log`, viewable directly in the settings UI with a one-click clear.
* **Scheduled purges** — WP Cron / Action Scheduler integration with any built-in schedule.
* **Scheduled log clearing** — Keep your log file tidy on its own schedule.
* **Export / Import settings** — Move your configuration between sites in seconds.
* **Multisite aware** — Cannot be network-activated by design; activate per-subsite for granular control.

== Installation ==

1. Download the plugin, unzip it, and upload to your site's `/wp-content/plugins/` directory.
   * Alternatively, upload the zip directly via **Plugins > Add New > Upload Plugin**.
   * Or search for "The Cache Purger" in the WordPress Plugin Repository and install from there.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Navigate to **The Cache Purge** in your admin menu to configure settings.

**Requirements:** PHP 8.2 or higher. WordPress 6.0 or higher.

== Frequently Asked Questions ==

= Why would I need this plugin? =

If you find yourself manually clearing caches in multiple places after every site update — or if you want to automate that process entirely — this plugin handles it all from one settings screen. It's especially useful on sites with complex stacks: a CDN in front, a caching plugin active, and a server-level cache underneath.

= Which cache types are purged by default? =

On a fresh install, Plugin Caches, WordPress Caches, Server Caches, and Memory Caches are all enabled. API/CDN caches (Cloudflare, Sucuri, Fastly) are opt-in, since they require API credentials.

= How do I set up Cloudflare, Sucuri, or Fastly purging? =

Go to **The Cache Purge > API/Server Settings**, enter your credentials, and make sure "API Caches" is included in your **Caches To Purge** selection on the Settings tab.

= How do I configure remote Redis, Memcache, or Memcached servers? =

Also under **API/Server Settings**. Enable the relevant toggle, then add your server IP(s), port(s), and any authentication or database details. Multiple servers are supported.

= Can I exclude specific posts or pages from triggering a purge? =

Yes. When you enable purging for posts, pages, or CPTs, an exclusion selector appears below it. Any content selected there will be ignored when saved or updated.

= How do I run a purge from the command line? =

```
wp the_cache purge
```

Add `--allow-root` if running as root. On a multisite, add `--url=https://yoursite.com` to target a specific subsite.

= Why can't this plugin be network-activated on a multisite? =

By design. Activating per-subsite gives each site its own independent configuration, which is almost always what you want in a multisite environment.

= Where is the purge log stored? =

At `{ABSPATH}wp-content/purge.log`. Enable logging under **Settings > Log Purge Actions?** and it will be viewable directly in the **The Purge Log** tab. You can clear it manually from that tab, or set it to auto-clear on a schedule under **CRON Action Settings**.

== Screenshots ==

1. Settings — General purge configuration and trigger options
2. Settings — GravityForms and ACF options (shown when those plugins are active)
3. API/Server Settings — Remote Redis, Memcache, Memcached, and CDN/WAF API keys
4. CRON Action Settings — Scheduled purge and log clearing configuration
5. The Purge Log — Live log viewer with manual clear button

== Changelog ==

= 2.2.78 =
* Upgrade: Fastly CDN library
* Swap: Settings framework
* Update: Menu names
* Add: Log purge to top menu
* Fix: Manual purge's security

= 2.1.63 =
* Bump: Minimum PHP version to 8.2
* Bump: Minimum WordPress version to 6.0
* Upgrade: Fastly CDN library
* Fix: GoDaddy cache purge not logging on scheduled/repeat purges
* Fix: Nginx cache purge pre-action hook
* Fix: Typo in SiteGround cache purge log call
* Fix: Sucuri API purge guard
* Fix: Varnish purge

= 2.1.36 =
* Update: Vendor libraries
* Bump: Minimum PHP version to 8.1
* Remove: WP-CLI cache clearing
* Restructure: Common functionality for better organization and slightly improved purge performance
* Add: Redis prefix/key scoped flushing
* Fix: Redis database-scoped flush
* Fix: load_textdomain deprecation notice

= 2.1.01 =
* Verify: WordPress 6.9 compatibility
* Verify: PHP 8.4 compatibility
* Add: Redis database ID and authentication support
* Update: Fastly CDN library
* Update: Action Scheduler library
* Add: Admin notice for sites running PHP 8.0 or lower

= 2.0.11 =
* Add: SpinUpWP hosting support
* Update: Documentation
* Update: Fastly CDN library
* Update: Action Scheduler library
* Fix: Action Scheduler calls for background purge jobs
* Fix: Footer link

= 1.9.89 =
* Verify: WordPress 6.7 compatibility
* Fix: Null check for purge type configuration
* Add: Fastly CDN purge support
* Replace: WP Cron with WooCommerce Action Scheduler for more reliable background processing
* Add: New action hooks — `tcp_cron_cache_purge`, `tcp_cron_log_purge`, `tcp_long_cache_purge`

= 1.9.27 =
* Verify: WordPress 6.6 compatibility
* Add: Flying Press plugin cache support
* Add: Setting to select which cache types are purged
* Add: Selfless plug

= 1.8.01 =
* Verify: PHP 8.3 compatibility
* Fix: PHP 8.x compatibility and deprecation notices
* Update: Framework JS libraries

= 1.7.33 =
* Verify: WordPress 6.5 compatibility
* Update: Minimum WordPress version to 5.6

= 1.7.12 =
* Fix: Missing variable on activation

= 1.7.11 =
* Optimize: Class loading via Composer autoloader
* Update: JS libraries (CodeMirror, Leaflet, etc.)
* Patch: PHP 8.2 deprecation notices

= 1.6.04 =
* Verify: WordPress 6.3 compatibility

= 1.6.03 =
* Fix: Warning for OPcache scripts
* Fix: Fatal error on log clearing in PHP 8+

= 1.5.99 =
* Verify: WordPress 6.2 compatibility
* Fix: Cron schedule check
* Fix: File cache clearing could cause a fatal error in some environments
* Fix: Long purge actions moved from admin-ajax to a one-time WP Cron job

= 1.5.22 =
* Fix: File cache clearing — better performance, suppresses warnings

= 1.5.12 =
* Add: Option to clear caches on plugin settings save
* Add: Purge log viewer tab in settings UI
* Add: Manual and cron-based log clearing
* Fix: tcp_post_purge hook
* Add: Pure Varnish purging support
* Update: Move Varnish and PageSpeed purging to admin-ajax for better wp-admin performance

= 1.4.02 =
* Verify: WordPress 6.1.2 compatibility
* Update: Settings field framework
* Fix: Purging action exclusions
* Update: Exclusion field labelling

= 1.3.11 =
* Fix: WP-Optimize static call to non-static method in PHP 8+
* Fix: Nginx cache purging — more path detection, more efficient clearing
* Fix: File cache purging — more efficient clearing
* Fix: Cloudflare and Sucuri purges — only attempt if API credentials are present
* Fix: Master Purge admin bar link positioning

= 1.2.79 =
* Fix: NitroPack purge AJAX response causing page redirect

= 1.2.66 =
* Add: NitroPack cache purge support
* Add: XCache purge support
* Update: Module structure
* Update: Logging actions

= 1.1.01 =
* Verify: WordPress 6.0 compatibility
* Verify: PHP 8.1 compatibility
* New: Plugin icon
* Update: Settings field framework

= 1.0.27 =
* Add: WP Cron-based scheduled cache purging with configurable schedules
* Add: WP-CLI purge command (`wp the_cache purge`)
* Fix: Sucuri purge logging
* Fix: Network activation guard
* Fix: Master Purge showing in network admin
* Fix: PageSpeed purge performance
* Fix: OOM issue on WooCommerce sites with large product catalogs
* Add: WP REST Cache purge support

= 0.8.88 =
* Add: Translation readiness (text domain: the-cache-purger)
* Add: Minified asset compilation with debug-mode detection

= 0.8.09 =
* Add: Elementor CSS auto-regeneration
* Add: Divi cache purge
* Update: W3 Total Cache, WP Super Cache, Hummingbird, Cache Enabler, LiteSpeed Cache, Kinsta, Autoptimize, WP-Optimize clearing
* Add: SiteGround, Bluehost, Cloudways (Breezeway) hosting cache purge

= 0.7.16 =
* Fix: Settings conflict with another plugin
* Add: Remote Redis, Memcache, Memcached server configuration
* Add: Direct Cloudflare and Sucuri API clearing

= 0.4.15 =
* Add: Manual Cache Purge button

= 0.3.98 =
* Initial feature build — purging methods, settings, documentation, export/import

= 0.1.01 =
* Initial release
=== The Cache Purger ===
Contributors: kevp75
Donate link: https://paypal.me/kevinpirnie
Tags: cache, cache purging, purge cache, caching, performance
Requires at least: 6.0
Tested up to: 7.0
Requires PHP: 8.2
Stable tag: 2.2.97
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

= 2.2.97 =
* Add: SQLite Object Cache support
* Upgrade: Fastly CDN library
* Upgrade: Action Scheduler library
* Upgrade: Field library
* Cleanup: Pre version 2

= 2.2.88 =
* Upgrade: Fastly CDN library
* Fix: Issue saving some fields in settings library

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

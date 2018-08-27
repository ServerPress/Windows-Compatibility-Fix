<?php
/**
Plugin Name: Windows Compatibility Fix
Plugin URL: https://serverpress.com/plugins/windows-compatibility-fix
Description: Fixes long filename problem on Windows systems when doing updates, such as updating from EDD based sites.
Version: 1.0.2
Author: Dave Jesch
Author URI: http://serverpress.com
Tags: must-use
Text Domain: windows-compatibility-fix
Domain path: /language
 */

if ( ! class_exists( 'DS_WindowsCompatabilityFix', FALSE ) ) {
	class DS_WindowsCompatabilityFix
	{
		private static $_upgrade = FALSE;

		public static function init()
		{
self::_debug( 'init()' );
			// only add the filters if running on Windows
			if ( 'Darwin' !== PHP_OS && FALSE !== strcasecmp('win', PHP_OS ) ) {
self::_debug( ' adding filters');
				add_filter( 'wp_unique_filename', array( __CLASS__, 'filter_unique_filename'), 1, 4 );
				add_filter( 'upgrader_pre_download', array( __CLASS__, 'filter_upgrader_download'), 1, 3 );
			} else {
self::_debug( ' filters not added PHP_OS=[' . PHP_OS . ']' );
			}
		}

		/**
		 * Callback for this 'wp_unique_filename' filter that adjusts the filename created in wp_tempnam()
		 * @param sring $filename The filename being created
		 * @param string $ext The file's extension
		 * @param string $dir The file's directory
		 * @param callback $unique_filename_callback The unique filename callback reference
		 * @return string The file name to use
		 */
		public static function filter_unique_filename( $filename, $ext, $dir, $unique_filename_callback )
		{
self::_debug( 'filter_unique_filename() called' );
			if ( self::$_upgrade && ( strlen( $filename ) > 120 && '.tmp' === $ext ) ) {
self::_debug( 'filter_unique_filename() long file name: ' . $filename );
self::_debug( ' ext=[' . $ext . ']  dir=[' . $dir . ']' );
				$file = tempnam( $dir, 'wcf' );		// creates a new, guaranteed unique filename with 'wcf' prefix
self::_debug( ' file=' . $file );
				@unlink( $file );					// remove the file, since we're changing the name by adding an extension
				$file .= $ext;						// add the extension to the filename being returned
self::_debug( ' returning [' . basename( $file ) . ']' );
				// the file name returned will not exist. this is the expected behavior in wp_tempnam()
				return basename( $file );			// return just the filename since wp_tempnam() adds the directory
			}

self::_debug( ' returning unmodified filename=[' . $filename . ']' );
			return $filename;						// the upgrade proces is not happening, just return the original filename value
		}

		/**
		 * Callback for 'upgrade_pre_download' filter called in WP_Upgrader->download_package().
		 * Used to signal the filter_unique_filename() method to modify the filename if it's too long
		 * @param boolean $result Result value.
		 * @param string $package The package URL.
		 * @param WP_Upgrade $wp_upgrader The instance of the WP_Upgrader class calling this filter
		 * @return boolean The unmodified $result value.
		 */
		public static function filter_upgrader_download( $result, $package, $wp_upgrader )
		{
self::_debug( 'filter_upgrader_download() called. setting flag.' );
			self::$_upgrade = TRUE;
			return $result;
		}

		/**
		 * Perform debug logging
		 * @param string $msg The message to log
		 */
		public static function _debug( $msg ) {
			if (defined('WP_DEBUG') && WP_DEBUG) {
				$file = dirname(__FILE__) . '/~log.txt';
				$fh = fopen($file, 'a+');
				if ( FALSE !== $fh ) {
					if ( NULL === $msg )
						fwrite( $fh, date("\r\nY-m-d H:I:s:\r\n") );
					else
						fwrite( $fh, date('Y-m-d H:i:s - ' ) . $msg . "\r\n" );
					fclose( $fh );
				}
			}
		}

	}
} // class_exists

// constant is not defined so prepend.php has not set up the filters
add_action( 'plugins_loaded', 'DS_WindowsCompatabilityFix::init' );

//DS_WindowsCompatabilityFix::_debug( 'loaded' );

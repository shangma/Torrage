<?php
	include_once dirname( __FILE__ ) . '/inc/main.inc.php';
	
	set_time_limit( 600 );
	ini_set( 'upload_max_filesize', 6 * 1048576 );
	
	print_head();
	
	echo "<h2>Upload:</h2>\n";
	
	upload_error_handler( handle_upload( $_FILES['torrent']['tmp_name'] ) );
	
	function upload_error_handler( $error )
	{
		global $SETTINGS;
		
		switch( $error )
		{
			case TORRAGE_FILE_NOT_FOUND:
				echo <<< HTML
		Error: File empty
		<p>If you want to upload another file, go <a href="/">back</a> to the main page.</p>

HTML;
			case TORRAGE_FILE_EMPTY:
				echo <<< HTML
		Error: File empty
		<p>If you want to upload another file, go <a href="/">back</a> to the main page.</p>

HTML;
			case TORRAGE_FILE_INVALID:
				echo <<< HTML
		Error: Broken torrent file, please recreate it and try again.
		<p>If you want to upload another file, go <a href="/">back</a> to the main page.</p>

HTML;
			case TORRAGE_FILE_UNKNOWN:
				echo 'Error 13';
			case TORRAGE_FILE_ERROR:
				echo <<< HTML
		Error: Something didn't work, please try again later!
		<p>If you want to upload another file, go <a href="/">back</a> to the main page.</p>

HTML;
			default:
				echo <<< HTML
		<p>Your torrentfile is now cached and can be downloaded at:<br />
		<br /><a href="/torrent/{$error}.torrent">http://{$SETTINGS['torrstoredns']}/torrent/{$error}.torrent</a></p>
		<p>If you want to upload another file, go <a href="/">back</a> to the main page.</p>

HTML;
		}
		
		print_foot();
		exit( 0 );
	}

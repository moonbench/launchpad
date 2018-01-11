<?php
/**
 * Common functions used for handling files
 *
 * These can be helpful for handling user-uploaded content
 * as well as server-generated files.
 */


//
// Limitations
//
const ALLOWED_FILE_TYPES = ["image/gif", "image/jpeg", "image/pjpeg", "image/x-png", "image/png"];
const MAX_UPLOAD_BYTES = 6100000;


/**
 * Generate a hash for an uploaded file
 */
function hash_for_file( $file ){
  return hash_file("sha256", $file["tmp_name"] );
}

/**
 * Generate a unique filename based on the current time
 */
function generate_server_filename( $file, $extra = ""  ){
  $file_type = explode(".", $file["name"]);
  $name = time();
  $name .= "x" . substr( md5($file["name"] . $file["size"]), 4, 2 );
  $name .= $extra;
  $name .= "." . strtolower(end($file_type));
  return $name;
}

/**
 * Generate a directory path in the format $directory/YEAR/MONTH/$file
 */
function generate_url_for_file( $file, $directory, $extra = "" ){
  $url = $directory . "/";
  $url .= date("Y") . "/" . date("m") . "/";
  $url .= generate_server_filename( $file, $extra );
  return $url;
}

/**
 * Create a string representation of the file size with human-readable units
 */
function format_bytes($size, $precision = 2){
  $base = log($size, 1000);
  $suffixes = array('', 'kb', 'Mb', 'Gb', 'Tb');
  return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}


/**
 * Create a directory on the server if it doesn't exist
 */
function make_directory_if_needed( $filepath ){
  $file_components = explode("/", $filepath);
  array_pop( $file_components );
  array_shift( $file_components );

  $path = APP_ROOT . "/..";
  foreach( $file_components as $directory ){
    $path .= "/" . $directory;
    if( !file_exists($path) || !is_dir($path) ){
      mkdir( $path );
      if( !file_exists($path) || !is_dir($path) ){
	trigger_error("Unable to find or create directory, $path");
	return;
      }
    }
  }
}


/**
 * Determine if an uploaded file meets the critera to be saved
 */
function is_acceptable_to_upload( $file ){
  if( !file_exists( $file["tmp_name"] )){
    trigger_error("Image failed to upload to the server correctly");
    return false;
  }

  $type = $file["type"];
  if( !in_array( $type, ALLOWED_FILE_TYPES )){
    trigger_error("Image type, '$type', is not whitelisted.");
    return false;
  }

  if( $file["size"] > MAX_UPLOAD_BYTES ){
    $size = format_bytes( $image_data["size"] );
    $max = format_bytes( MAX_UPLOAD_BYTES );
    trigger_error("Image is too big. Upload: $size, Maximum: $max");
    return false;
  }

  return true;
}

/**
 * Move an uploaded file from the temporary directory to a server directory
 */
function copy_uploaded_file_to_directory( $file, $url ){
  if( !is_acceptable_to_upload( $file )){
    trigger_error("Server cannot keep the uploaded file");
    return;
  }

  $filepath = APP_ROOT . "/../" . $url;
  if( file_exists( $filepath )){
    trigger_error("Duplicate file exists at $filepath");
    return;
  }

  make_directory_if_needed( $url );
  if( !\app\error::is_empty() ) return;

  move_uploaded_file( $file["tmp_name"], $filepath );
}
?>
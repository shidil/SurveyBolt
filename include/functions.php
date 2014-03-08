<?php
/*
 Index for the application
 this acts as a container for the procedural functions
 @author Shidil Boss
 16-2-2014 10:23 PM
 *
 */
function includeFile($file) {
	include FROOT . 'templates/' . $file . '.php';
}

function redirect($path) {
	header("Location: " . $path . "");
}

function createDialog($title, $body) {
	echo '<div id="dialog_box_generic">
			<div rel="title">
					' . $title . '
			</div>
			<div rel="body">
				' . $body . ';
			</div>
		</div>';
}
function string2KeyedArray($string, $delimiter = '&', $kv = '=') {
  if ($a = explode($delimiter, $string)) { // create parts
    foreach ($a as $s) { // each part
      if ($s) {
        if ($pos = strpos($s, $kv)) { // key/value delimiter
          $ka[trim(substr($s, 0, $pos))] = trim(substr($s, $pos + strlen($kv)));
        } else { // key delimiter not found
          $ka[] = trim($s);
        }
      }
    }
    return $ka;
  }
} // string2KeyedArray
?>
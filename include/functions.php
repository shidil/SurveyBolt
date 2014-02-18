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
?>
<?php

includeFile('header');
includeFile('index');
?>
<script>
	$(document).ready(function() {
		$('#login_error').show();
		$('#login_form').w2popup();
	}); 
</script>
<?php

includeFile('footer');
?>

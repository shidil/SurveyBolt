<?php

includeFile('header');
includeFile('index');
?>
<script>
	$(document).ready(function() {
		$('#register_error').show();
		$('#register_form').w2popup();
	}); 
</script>
<?php

includeFile('footer');
?>

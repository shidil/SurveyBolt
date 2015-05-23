<?php

if ($uSys->isLoggedIn()) {
    redirect(DOMAIN . 'dashboard/');
}
if ($_POST) {
    if ($_POST['username']) {
        $username = $_POST['username'];
        $uSys = new UserSystem;
        if ($uSys->isUser($username)) {
            $code = encryptMe($username);
            echo $code;
            includeFile('forgot-2');
        }
		else {
			includeFile('forgot-1');?>
			<script>
	$(document).ready(function() {
		w2alert('Invalid username.');
	}); 
</script>
<?php			
		}
    }
    elseif($_POST['code']){
        $username = decryptMe($_POST['code']);
        $uSys = new UserSystem;
        if ($uSys->isUser($username)) {
            Bolt::$db->update('users',array('password'),array(encryptMe($_POST['pass_confirmation'])),'userName=\''.$username.'\'') ;
            includeFile('forgot-3');
        }
    }
} else {
    includeFile('forgot-1');
}
?>

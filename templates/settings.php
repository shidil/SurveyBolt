<?php

includeFile('header-logout');
$uSys = new UserSystem;
$user=$uSys->getUser();
?>
	<div>Settings</div>
	<div>Account preferences</div>
	<form action="<?php echo DOMAIN;?>dashboard/?action=settings" method="post">
						<div>
							Full name:
							<input type="text" size="20" value=" <?php echo $user->getName(); ?> " name="name"/>
						</div>
						Username:
							<input type="text" size="20" value="<?php echo $user->getUsername(); ?>" name="usrname" readonly="readonly" />
						</div>
						</div>
						Email:
							<input type="text" size="20" value="<?php echo $user->getEmail(); ?>" name="email"/>
						</div>
						<div>
						<input type="submit" value="Save"/>
						</div>
		</form>
<?php
	if($_POST){
		$newName=$_POST['name'];
		$newEmail=$_POST['email'];
		
	}?>
		<div>Password settings</div>
	<form action="<?php echo DOMAIN;?>dashboard/?action=settings" method="post">
						<div>
							Old password:
							<input type="password" size="20" placeholder="Password" name="password"/>
						</div>
						New password:
							<input type="password" size="20" placeholder="New password" name="newPassword"/>
						</div>
						</div>
						Retype password:
							<input type="password" size="20" placeholder="Retype password" name="rePassword"/>
						</div>
						<div>
						<input type="submit" value="Save"/>
						</div>
					</form>
<?php
	if($_POST){
		
		if(encryptMe($_POST['password']) != $user->getPassword())
			print "password not match";
		$newName=$_POST['password'];
		$newEmail=$_POST['rePassword'];
		
	}?>
<?php
includeFile('footer');
?>
<html>
	
	<body>
			<form action="test.php" method="post">
				<input type="text" size="20" name="code"/>
				<input type="text" size="20" name="decode"/>
				<input type="submit"  />
			</form>
	</body>
</html>
<?php
$s='2014-03-16 10:11:40';
echo substr($s,8,2);
	include 'include/encode.php';
	if($_POST['code'])
		$data=encryptMe($_POST['code']);
	if($_POST['decode'])
		$data=decryptMe($_POST['decode']);
	echo ($data);


?>
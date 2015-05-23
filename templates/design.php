<?php
includeFile('header-logout');
$surveyID = decryptMe(Bolt::$_get['id']);
$sSys=new SurveySystem;
//$uSys = new UserSystem;
//$survey= $sSys->getSurveyByID($surveyID);
?>
<div id="design_body">
<h3>Themes</h3>
<div id="design_form">
	<form action="" method="post">
		
            <div><input type="radio" name="design1" value="1">
		<img src="<?php echo DOMAIN; ?>contents/images/design1.png" style="width:100; "/>Notebook</div>
		<div><input type="radio" name="design1" value="2">
		<img src="<?php echo DOMAIN; ?>contents/images/design2.png" style="width:100; "/>Theme 2</div>
		<div><input type="radio" name="design1" value="3">
		<img src="<?php echo DOMAIN; ?>contents/images/design3.png" style="width:100; "/>Theme 3</div>
		<div><input type="radio" name="design1" value="4">
		<img src="<?php echo DOMAIN; ?>contents/images/design4.png" style="width:100; "/>Theme 4</div>
		<div><input type="submit" value="Save" id="login_button"></div>
		
	</form>
</div>
</div>
<?php 
if($_POST['design1'])
{
	Bolt::$db->update('surveys',array('design'),array($_POST['design1']),'surveyID=\'' . $surveyID . '\'');
	redirect('action=edit&id='.encryptMe($surveyID));
}
includeFile('footer');
?>

<?php
includeFile('header-logout');
$uSys = new UserSystem;
$user = $uSys->getUser();
?>
<?php
if ($_POST) {
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];
    Bolt::$db->update('users', array('fullName', 'email'), array($newName, $newEmail), 'userID=\'' . $user->getID() . '\'');

    $uSys = new UserSystem;
    $user = $uSys->getUser();
}
?>

<?php
if ($_POST) {

    if (encryptMe($_POST['password']) != $user->getPassword())
        print "password not match";
    else{
    $password = encryptMe($_POST['newPassword']);
    Bolt::$db->update('users', array('password'), array($password), 'userID=\'' . $user->getID() . '\'');

    $uSys = new UserSystem;
    $user = $uSys->getUser();
    }
}
?>


<section id="setting_change">
    <div style="
         padding-bottom: 11;
         padding-top: 11;">Settings</div>
    <div id="setting_top">Account preferences</div>
    <form id="setting_form" action="<?php echo DOMAIN; ?>dashboard/?action=settings" method="post">

        Full name:
        <div class="setting_form">
            <input type="text" size="20" value=" <?php echo $user->getName(); ?> " name="name"/>
        </div>

        Username:
        <div class="setting_form">
            <input type="text" size="20" value="<?php echo $user->getUsername(); ?>" name="usrname" readonly="readonly" />
        </div>

        Email:
        <div class="setting_form">
            <input type="text" size="20" value="<?php echo $user->getEmail(); ?>" name="email"/>
        </div>
        <div>
            <input type="submit" value="Save" id="setting_savebutten"/>
        </div>
    </form>
</section>

<section id="setting_change">
    <div id="setting_top">Password settings</div>
    <form id="setting_form" action="<?php echo DOMAIN; ?>dashboard/?action=settings" method="post">

        Old password:
        <div class="setting_form">
            <input type="password" size="20" placeholder="Password" name="password"/>
        </div>
        New password:
        <div class="setting_form">
            <input type="password" size="20" placeholder="New password" name="newPassword"/>
        </div>

        Retype password:
        <div class="setting_form">
            <input type="password" size="20" placeholder="Retype password" name="rePassword"/>
        </div>
        <div>
            <input type="submit" value="Save" id="setting_savebutten"/>
        </div>
    </form>
</section>
<?php includeFile('footer'); ?>
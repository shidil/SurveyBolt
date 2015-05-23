<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$uSys = new UserSystem;if($uSys->isLoggedIn())
    includeFile('header-logout');
else
    includeFile('header');
?>
Survey not found or forbidden

<?php
includeFile('footer');

?>
<?php
includeFile('header');
?>
<section id="highlights">
    <h2 class="page_title">Forgot password?</h2>
    <form action="<?php echo DOMAIN; ?>forgot" method="post" class="page_form">

        <span>Username:</span>
        <div>

            <input type="text" size="20" placeholder="username" name="username" id="username"/>
        </div>

        <input type="submit" value="Send Request" />
    </form>
    <div class="big_photo"></div>
</section>


<?php
includeFile('footer');
?>

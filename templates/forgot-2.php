<?php
includeFile('header');
?>
<section id="highlights">
    <h2 class="page_title">Forgot password?</h2>
    <form action="<?php echo DOMAIN; ?>forgot" method="post" class="page_form">

        <span>Enter the code:</span>
        <div>

            <input type="text" size="20" placeholder="enter the code here" name="code" id="username"/>
        </div>
        <span>Password:</span>
        <div>

            <input  type="password" name="pass_confirmation"    data-validation="length" data-validation-length="min8"/>
        </div>
        <span>Re-enter password:</span>
        <div>

            <input  type="password" name="pass"  data-validation="confirmation"/>
        </div>
        <input type="submit" value="Reset password" />
    </form>
      <script>

                                          $.validate({
                                            modules :   'security'
                                          });


                                        </script>
    <div class="big_photo"></div>
</section>


<?php
includeFile('footer');
?>

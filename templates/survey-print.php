<?php
global $survey_item;
$surveyID = $survey_item->getID();
$questions = $survey_item->getQuestions();
$i = $survey_item->getDesignById($surveyID);
includeFile('header-survey');

if ($i == 1) {
    ?>
    <link rel="stylesheet" href="<?php echo DOMAIN; ?>contents/css/theame1.css" type="text/css" />
<?php }
if ($i == 2) {
    ?>
    <link rel="stylesheet" href="<?php echo DOMAIN; ?>contents/css/theame2.css" type="text/css" />
<?php }
if ($i == 3) {
    ?>
    <link rel="stylesheet" href="<?php echo DOMAIN; ?>contents/css/theame3.css" type="text/css" />
<?php }
if ($i == 4) {
    ?>
    <link rel="stylesheet" href="<?php echo DOMAIN; ?>contents/css/theame4.css" type="text/css" />
<?php } ?>
<div id="theame">
    <section id="form_container">
        <h3><?php echo $survey_item->getName(); ?></h3>
        <form id="survey_form" method="post" action="<?php echo DOMAIN . 'app/' . encryptMe($survey_item->getID()); ?>">

            <?php
            foreach ($questions as $key => $question) {
                echo $question->toString();
            }
            ?>
            <div class="survey_item">
                <div class="item_title">Your email</div>
                <div class="item_help_button" data="' . $this -> getHelp() . '"></div>
                <div class="item_feild">
                    <input type="email" name="email" size="100" required />
                </div>
            </div>
            <input type="submit" />
        </form>
    </section>
</div>
<?php
includeFile('footer');
?>

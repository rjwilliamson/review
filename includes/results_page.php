<?php require_once('includes/header.php'); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("php/connect.php"); ?>

<section id="company_header">
<h2><?php echo $companyName ?></h2>
</section>

<section id="warning_comments">

<P>Warning,once you comment there is no going back,so be carefull what you say</P>

</section>

<section id="comments">

<p id="comment_count"><?php getCommentCount($conn,$_GET['q']); ?></p>
<textarea id="comment_box"></textarea>
<button id="commentBtn">Comment</button>
<input id="url" type="hidden" value="<?php echo $_GET['q'] ?>">

</section>


<div id="comment_results"><?php getComments($conn,$_GET['q']); ?></div>

<script src="assets/js/comments.js"></script>
<?php require_once('includes/footer.php'); ?>
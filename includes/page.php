<?php

require_once("includes/menu.php");
?>

<div id="content">
   <div id="firstrow">
	<div id="pagerandom">
	<?php require_once('includes/page/random.php'); ?>
	</div>
	<div id="pagesearch">
	<?php require_once('includes/page/search.php'); ?>
	</div>
    </div>

    <div id="secondrow">
	<div id="pagelatest">
	<?php require_once('includes/page/latest.php'); ?>
	</div>
	<div id="pagepopular">
	<?php require_once('includes/page/popular.php'); ?>
	</div>
	<div id="pagetag">
	<?php require_once('includes/page/tag.php'); ?>
	</div>
    </div>
	

</div>
<?php

require_once("includes/random.php");
?>

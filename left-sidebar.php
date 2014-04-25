<?php
$b=new books();
?>
		<div id="left-sidebar">
			<h2>Browse</h2>
			<h3>Categories of Books</h3>
			<ul>
				<?php $b->listallcategories() ?>
			</ul>
		</div><!--End of left-sidebar-->
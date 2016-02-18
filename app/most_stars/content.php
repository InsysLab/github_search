<div class="container">

	<h1>Popular PHP Repositories on Github</h1>
	
	<ul id="repo-list">
		<?php foreach($repositories as $key => $repo): ?>
			<li>
				<a tabindex="0" role="button" data-container="body" data-toggle="popover" data-placement="right" 
					title="<b><?php echo $repo['name'] ?></b>" data-trigger="focus" data-html="true"
					data-content="ID: <?php echo $repo['id'] ?> <br/>
								  URL: <a href='<?php echo $repo['url'] ?>'><?php echo $repo['url'] ?></a> <br/>
								  Description: <?php echo strip_tags($repo['description'])?> <br/>
								  Stars: <b><?php echo $repo['stars'] ?></b> <br/>
								  Created: <?php echo date('M d, Y', strtotime($repo['created'])) ?> <br/>
								  Last pushed: <?php echo date('M d, Y', strtotime($repo['pushed'])) ?>
								  ">
					<?php echo $repo['name'] ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	
</div>
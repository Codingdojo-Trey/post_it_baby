<html>
<head>
	<title>AJAX ROCKS!</title>
	<link rel="stylesheet" type="text/css" href="/assets/stylesheets/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src='/assets/javascripts/notes.js'></script>
</head>
<body>
	<h1>This is an awesome note taking app!</h1>
	<div id='notes'>
		<?php 
			foreach($notes as $note)
			{
				echo "<div class='note' id='{$note['id']}' contenteditable='true'>
						<a href='/notes/delete/{$note['id']}' class='delete'>X</a>
						<h2>{$note['title']}</h2>
						<p>{$note['message']}</p>
					  </div>";
			}
		?>
	</div>
	<h2>Add a new note!</h2>
	<form id='newForm' action='/notes/create' method='post'>
		Name:<input type='text' name='title'><br>
		Message:<textarea name='message'></textarea>
		<input type='submit' value='add new note!'>
	</form>
</body>
</html>
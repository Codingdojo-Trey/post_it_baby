<html>
<head>
	<title></title>
</head>
<style type="text/css">
	.note
	{
		display: inline-block;
		width: 200px;
		height: 200px;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('#add_form').submit(function(){
			$.post($this.attr('action'), $(this).serialize(), function(data){
				$('#notes').append("<div class='note'>"+
					"<a class='delete' href='/notes/delete/"+data.id+"'>x</a>" +
					"<form action='/notes/update/"+data.id+"'class='update'>"+
						"<textarea>This is where my description will go!</textarea>" +
						"<input type='submit' value='edit'>" +
					"</form> </div>")
			}, 'json')
			return false;
		})

		$('.delete').click(function(){
			var note = $(this);
			$.post($(note).attr('href'), function(){
				$(note).parent().remove();
			});
			return false;
		})

	});
</script>
<body>
	<h3>Here are all of the notes!</h3>
	<div id='notes'>
		<div class='note'>
			<a class='delete' href="/notes/delete/333">x</a>
			<form action='/notes/update/333' class='update'>
				<textarea>This is where my description will go!</textarea>
				<input type='submit' value='edit'>
			</form>
		</div>
		<?php 
			foreach ($notes as $note) 
			{
				$id = $note['id'];
				$msg = $note['message'];
				$title = $note['title'];
				echo "  <div class='note'>
							<a class='delete' href='/notes/delete/{$id}'>x</a>
							<h3> {$title} </h3>
							<form action='/notes/update/{$id}' class='update'>
								<textarea>{$msg}</textarea>
								<input type='submit' value='edit'>
							</form>
						</div>";
			}
		 ?>
	</div>
	<h2>Add a new note!</h2>
	<form id='add_note' action='/notes/create' method='post'>
		Title: <input type='text' name='title'>
		Message: <textarea name='message'></textarea>
		<input type='submit' value='create note!'>
	</form>
</body>
</html>
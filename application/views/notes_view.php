<html>
<head>
	<title></title>
</head>
<style type="text/css">

	*
	{
		font-family: sans-serif;
	}

	.note
	{
		display: inline-block;
		width: 200px;
		height: 200px;
		background-color: lightblue;
		margin: 8px;
		vertical-align: top;
	}

	.update_title
	{
		display: block;
		margin: 18.720px 0px;
	}

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#add_note').submit(function(){
			$.post($(this).attr('action'), $(this).serialize(), function(data){
				$('#notes').append("<div class='note'>"+
					"<a class='delete' href='/notes/delete/"+data.id+"'>x</a>" +
					"<h3 data_id ='"+data.id+"' class='title'>"+ data.title+"</h3>" +
					"<p class='update_paragraph' id='"+ data.id +"'>"+data.message+"</p> </div>")
			}, 'json')
			return false;
		})

		$(document).on('click', '.delete', function(){
			var note = $(this);
			$.post($(note).attr('href'), function(){
				$(note).parent().remove();
			});
			return false;
		})

		$(document).on('submit', '.update', function(){
			var form = $(this);
			$.post($(form).attr('action'), $(form).serialize(), function(data){
				var id = $(form).attr('id');
				$(form).replaceWith("<p class='update_paragraph' id='" + id + "'>"+ data +"</p>");
			}, 'json')
			return false;
		})

		$(document).on('focusout', '.awesome', function(){
			$(this).parent().submit();
		})

		$(document).on('click', '.title', function(){
			var text = $(this).text();
			var id = $(this).attr('data_id');
			$(this).replaceWith("<input class='update_title' type='text' data_id='" + id + "' value='"+text+"'>");
		})

		$(document).on('focusout', '.update_title', function(){
			var new_title = $(this).val();
			var id = $(this).attr('data_id');
			var url = "/notes/update_title/"+id+"/"+encodeURIComponent(new_title);
			//using a get request without a form!  This is how I can move data without refreshing!
			$.get(url, function(data){alert("updated the title!")});
			//replaceWith = your new favorite jQuery method
			$(this).replaceWith("<h3 class='title' data_id='"+ id +"'>"+new_title+"</h3>");

		})

		$(document).on('click', '.update_paragraph', function(){
			//
			var text = $(this).text();
			//Maintaining control of the IDs is essential to doing this right.  
			var id = $(this).attr('id');
			$(this).replaceWith("<form id='"+ id +"' action='/notes/update/"+id+"' class='update' method='post'>" +
				 					"<textarea name='message' class='awesome'>"+ text + "</textarea>" +
								"</form>");
		})

	});
</script>
<body>
	<h3>Here are all of the notes!</h3>
	<div id='notes'>
		<?php 
			foreach ($notes as $note) 
			{
				$id = $note['id'];
				$msg = $note['message'];
				$title = urldecode($note['title']);
				echo "  <div class='note'>
							<a class='delete' href='/notes/delete/{$id}'>x</a>
							<h3 class='title' data_id='{$id}'> {$title} </h3>
							<p class='update_paragraph' id='{$id}'>{$msg}</p>
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
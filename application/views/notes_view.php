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
		background-color: lightblue;
		margin: 8px;
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
					"<h3 data_id ='"+data.id+"' class='title'>"+ data.title+"</h3>" +
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

		$(document).on('submit', '.update', function(){
			$.post($(this).attr('action'), $(this).serialize(), function(){
				alert('successfully updated a note!');
			})
			return false;
		})

		$(document).on('focusout', '.awesome', function(){
			$(this).parent().submit();
		})

		$(document).on('click', '.title', function(){
			var text = $(this).text();
			var id = $(this).attr('data_id');
			$(this).replaceWith("<input class='update_title' type='text' data_id='" +id+ "' value='"+text+"'>");
		})

		$(document).on('focusout', '.update_title', function(){
			var new_title = $(this).val();
			var id = $(this).attr('data_id');
			var url = "/notes/update_title/"+id+"/"+encodeURIComponent(new_title);
			//using a get request without a form!  This is how I can move data without refreshing!
			$.get(url, function(data){alert("updated the title!")});
			$(this).replaceWith("<h3 class='title' data_id='"+ id +"'>"+new_title+"</h3>");

		})

	});
</script>
<body>
	<h3>Here are all of the notes!</h3>
	<div id='notes'>
		<!-- <div class='note'>
			<a class='delete' href="/notes/delete/333">x</a>
			<form action='/notes/update/333' class='update'>
				<textarea>This is where my description will go!</textarea>
				<input type='submit' value='edit'>
			</form>
		</div> -->
		<?php 
			foreach ($notes as $note) 
			{
				$id = $note['id'];
				$msg = $note['message'];
				$title = urldecode($note['title']);
				echo "  <div class='note'>
							<a class='delete' href='/notes/delete/{$id}'>x</a>
							<h3 class='title' data_id='{$id}'> {$title} </h3>
							<form action='/notes/update/{$id}' class='update' method='post'>
								<textarea name='message' class='awesome'>{$msg}</textarea>
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
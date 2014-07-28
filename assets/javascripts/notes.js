$(document).ready(function(){

	$('#newForm').submit(function(){
		//here goes my Ajax call:
		$.post( $(this).attr('action'), $(this).serialize(), function(data){
			console.log(data);
			//use the data coming back from the server to add dynamically rendered HTML!
			$('#notes').append("<div class='note' id='"+data.id+"' contenteditable='true'>" +
									"<a href='/notes/delete/"+data.id+"' class='delete'>X</a>" + 
									"<h2>"+data.title+"</h2>"+
									"<p>"+data.message+"</p>"+
								"</div>");
						//reset the form elements to look nice!
						$('input[type=text], textarea').val('');
		}, 'json');

		return false;
	})

	//make the notes we added after page load deletable 
	$('#notes').on('click', '.delete', function(){
		var that = this;
		$.get($(this).attr('href'), function(){
			//grab the note's parent and destroy it!
			$(that).parent().remove();
		})
		
		
		return false;
	})

	$('#notes').on('focusout', '.note', function(){

		var id = $(this).attr('id');
		var url = '/notes/update/'+id;
		var title = $(this).children('h2').text();
		var message = $(this).children('p').text();
		
		$.post(url, {title: title, message: message}, function(){
			console.log('in callback');
		})
	})
})
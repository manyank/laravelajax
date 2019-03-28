<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-6 offset-3">
				<br>
				<input type="text" class="form-control" id="search" aria-describedby="emailHelp" placeholder="Serach Article">
				<br>
				<ul class="list-group" id="data-div">
					<li class="list-group-item"><span>List Articles</span> <span class="pull-right"><a href="#" data-toggle="modal" data-target="#exampleModal"><i id="plusbtn" class="fa fa-plus" aria-hidden="true"></i></a></span></li>
					@foreach($items as $item)
					<li data-toggle="modal" data-target="#exampleModal" class="list-group-item list-item">{{ $item->title }}  <input type="hidden" id="itemid" value="{{ $item->id }}"></li>
					
					@endforeach					
				</ul>
			</div>
		</div>

		<!-- modal  -->

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add New Article</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							{{ csrf_field() }}
							<div class="form-group">
								<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Article Title">
								<input type="hidden" id="id" value="">

							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal" id="delete" style="display: none;">Delete</button>
						<button type="button" class="btn btn-primary" id="savechanges" data-dismiss="modal" style="display: none;">Save changes</button>
						<button type="button" id="addarticle" data-dismiss="modal" class="btn btn-primary">Add Article</button>

					</div>
				</div>
			</div>
		</div>



	</div>


</body>
<script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.list-item', function(event){
			var text = $(this).text();
			var id = $(this).find('#itemid').val();
			$('#exampleModalLabel').text('Edit Article');
			$('#exampleInputEmail1').val(text);
			$('#addarticle').hide();
			$('#delete').show();
			$('#savechanges').show();
			$('#id').val(id);
		});

		
		$(document).on('click', '#plusbtn', function(event){
				//var text = $(this).text();
				$('#exampleModalLabel').text('Add New Article');
				$('#exampleInputEmail1').val("");
				$('#addarticle').show();
				$('#delete').hide();
				$('#savechanges').hide();
			});

		$(document).on('click', '#addarticle', function(event){
			var value = $.trim($('#exampleInputEmail1').val());
			$.post( "list", { 'text': value,'_token':$('input[name=_token]').val() }, function( data ) {
				$("#data-div").load(" #data-div");
				$('#exampleInputEmail1').val("");
			});
		})

		/*delete code is here*/
		$("#delete").click(function(){
			if(confirm("Are you sure you want to delete this?")){
				var id = $('#id').val();
			//console.log(id);
			$.post( "delete", { 'id': id,'_token':$('input[name=_token]').val() }, function( data ) {
				$("#data-div").load(" #data-div");
				console.log(data);
			});
		}
	   })	

		/*update code is here*/
		$("#savechanges").click(function(){
			var id = $('#id').val();
			var value = $('#exampleInputEmail1').val();
			//console.log(id);
			$.post( "update", { 'id': id,'value': value,'_token':$('input[name=_token]').val() }, function( data ) {
				$("#data-div").load(" #data-div");
				console.log(data);
				//$('#exampleInputEmail1').val("");
			});

		});

		$( function() {
			$( "#search" ).autocomplete({
				source: 'http://127.0.0.1:8000/search'
			});
		} );


	});


</script>


</html>
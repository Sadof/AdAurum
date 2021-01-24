@extends("layouts.base")
	@section('content')
	<h2>Страница компании {{ $company->name }}.</h2>
	@auth

		<!-- <p>Название: {{ $company->name }}<button name="1" class="show">+</button><button name="1" class="hide">-</button></p>
		<form class="comment" id="1" style="display:none;">
			<div class="mb-3">
				<input type="text" class="form-control">
			</div>
			<input type="submit" class="btn btn-primary" name="1">
		</form> -->
		<div>
			<p><b>ИНН</b>: {{ $company->inn }}<button name="2" class="hide">-</button><button name="2" class="show">+</button></p>
			<form class="comment comment-hidden" id="2">
				<div class="mb-3">
					<input type="text" class="form-control">
				</div>
				<input type="submit" class="btn btn-primary mt-3" name="2">
			</form>
		</div>
		<div>
			<p><b>Общая информация</b>: {{ $company->general_information }} <button name="3" class="hide">-</button><button name="3" class="show">+</button></p>
			<form class="comment comment-hidden" id="3">
				<div class="mb-3">
					<input type="text" class="form-control">
				</div>
				<input type="submit" class="btn btn-primary" name="3">
			</form>
		</div>
		<div>
			<p><b>Генеральный директор</b>: {{ $company->ceo }}<button name="4" class="hide">-</button><button name="4" class="show">+</button></p>
			<form class="comment comment-hidden" id="4">
				<div class="mb-3">
					<input type="text" class="form-control">
				</div>
				<input type="submit" class="btn btn-primary" name="4">
			</form>
		</div>
		<div>
			<p><b>Адрес</b>: {{ $company->adress }}<button name="5" class="hide">-</button><button name="5" class="show">+</button></p>
			<form class="comment comment-hidden" id="5">
				<div class="mb-3">
					<input type="text" class="form-control">
				</div>
				<input type="submit" class="btn btn-primary" name="5">
			</form>
		</div>
		<div>
			<p><b>Телефон</b>: {{ $company->phone_number }}<button name="6" class="hide">-</button><button name="6" class="show">+</button></p>
			<form class="comment comment-hidden" id="6">
				<div class="mb-3">
					<input type="text" class="form-control">
				</div>
				<input type="submit" class="btn btn-primary" name="6">
			</form>
		</div>
		<h4><a href="" id="show" class="a-com">Комментарий к компании.</a></h4>
		<form class="comment comment-hidden mb-4" id="0">
			<div class="mb-3">
				<input type="text" class="form-control">
			</div>
			<input type="submit" class="btn btn-primary" name="0">
		</form>
		<input type="hidden" id="company_id" value="{{ $company->id }}">
		<section class="comment_section">
  			@forelse ($comments as $comment)
			<div class="card mb-1">
				<div class="card-body">
					<h5 class="card-title">{{ Auth::user()->name }} прокометировал {{ $column_name[$comment->column_id] }}</h5>
					<h6 class="card-subtitle mb-2 text-muted">{{ $comment->created_at }}</h6>
					<p class="card-text">{{ $comment->comment }}</p>
				</div>
			</div>
		@empty
		<div class="no_comment">
			<p>Комментарии отсутсвуют.</p>
		</div>
		@endforelse
		</section>
		<div class="card empty-card mt-3" style="display:none; ">
				<div class="card-body">
					<h5 class="card-title empty-title"></h5>
					<h6 class="card-subtitle mb-2 text-muted empty-date"></h6>
					<p class="card-text empty-text"></p>
			</div>
		</div>
		<script type="text/javascript">
			let card = $('.empty-card')
			let empty_title = $('.empty-title');
			let empty_date = $('.empty-date');
			let empty_text = $('.empty-text');
			$('#show').click(function(e) {
				e.preventDefault();
		  		($("#0").is(":hidden") == 1) ? $("#0").show(): $("#0").hide();
			});
			$('.show').click(function(e){
				$("#" + e.target.name).show();
			});
			$('.hide').click(function(e){
				$("#" + e.target.name).hide();
			});
			$('.comment').submit(function(event){
				event.preventDefault();
				let column_id = $(event.target).attr('id');
				let company_id = $('#company_id').val();
				let comment = $('#' + column_id + " input").first().val();
				if (comment){
				$.ajaxSetup({
				  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
				});
				$.ajax({
					type: "POST",
					url: company_id + "/ajax",
					data: {'column_id': column_id,
							'company_id': company_id,
							'comment': comment},
					success: function(data){
						$(event.target).hide();
						$('#' + column_id + " input").first().val("");
						empty_title.text("{{ Auth::user()->name }} прокометировал " + data[1]);
						empty_date.text(data[0]);
						empty_text.text(comment);
						$('.comment_section').prepend(card.clone().show());	
						if ($(".no_comment")) $(".no_comment").remove();

					}
					
				});}
			})
		</script>
	@else
		<!-- <p>Название: {{ $company->name }}</p> -->

		<p><b>ИНН</b>: {{ $company->inn }}</p>
		
		<p><b>Общая информация</b>: {{ $company->general_information }} </p>
	
		<p><b>Генеральный директор</b>: {{ $company->ceo }}</p>
		
		<p><b>Адрес</b>: {{ $company->adress }}</p>
		
		<p><b>Телефон</b>: {{ $company->phone_number }}</p>
		
	@endauth
	@endsection
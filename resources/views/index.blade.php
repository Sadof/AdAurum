@extends("layouts.base")
	@section('content')
		@if (count($companies)>0)
			<div class="row row-cols-1 row-cols-md-4 g-4">
	  		@foreach ($companies as $company)	
			  <div class="col">
			    <div class="card h-100">
			      <div class="card-body">
			        <h5 class="card-title"><a href="/{{$company->id}}" class="card-link">{{ $company->name }}</a></h5>
			        <p class="card-text">{{ Illuminate\Support\Str::limit($company->general_information, 50) }}</p>
			        <p class="card-text">Телефон: {{ $company->phone_number }}</p>
			        <p class="card-text">Адрес: {{ $company->adress }}</p>
			      </div>
			    </div>
			  </div>
			@endforeach
			</div>
	  	@else
	  		<p> No companies yes!</p>
	  	@endif	
		<button id="show" class="btn btn-primary mt-3">Добавить компанию.</button>
			<form action="" method="POST" id="add_form" @empty($errors->any()) style="display:none" @endempty>
				@csrf
					@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			  <div class="mb-3">
			    <label for="name" class="form-label">Name</label>
			    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
			  </div>
			  <div class="mb-3">
			    <label for="inn" class="form-label">ИНН</label>
			    <input type="number" class="form-control" id="inn" name="inn" value="{{ old('inn') }}">
			  </div>
			 <div class="mb-3">
			    <label for="general_information" class="form-label">Общая информация</label>
			    <input type="text" class="form-control" id="general_information" name="general_information" value="{{ old('general_information') }}">
			  </div>
			 <div class="mb-3">
			    <label for="ceo" class="form-label">Генеральный директор</label>
			    <input type="text" class="form-control" id="ceo" name="ceo" value="{{ old('ceo') }}">
			  </div>
			   <div class="mb-3">
			    <label for="adress" class="form-label">Адрес</label>
			    <input type="text" class="form-control" id="adress" name="adress" value="{{ old('adress') }}">
			  </div>
			   <div class="mb-3">
			    <label for="phone_number" class="form-label">Телефон</label>
			    <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
			  </div>
			  
			<button type="submit" class="btn btn-primary">Добавить</button>
		</form>
		</div>    
	</body>
	<script type="text/javascript">
		$('#show').click(function() {
		  	($("#add_form").is(":hidden") == 1) ? $("#add_form").show(): $("#add_form").hide();
		});
	</script>
@endsection
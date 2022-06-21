<div class="box-body">
	<div class="form-group">
		 {{ Form::label('name', trans('labels.companies.name'), ['class' => 'col-lg-2 control-label required']) }}
		 <div class="col-lg-10">
		 	{{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.companies.name')]) }}
		 </div>
	</div>
	<div class="form-group">
		 {{ Form::label('email', trans('labels.companies.email'), ['class' => 'col-lg-2 control-label required']) }}
		 <div class="col-lg-10">
		 	{{ Form::text('email', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.companies.email')]) }}
		 </div>
	</div>
	<div class="form-group">
		 {{ Form::label('logo', trans('labels.companies.logo'), ['class' => 'col-lg-2 control-label required']) }}
		 <div class="col-lg-10">
		 	{{ Form::file('image', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.companies.logo')]) }}
			<br/><br/>
			@isset($companies)
				<img src="{{ url('public/storage/images/'.$companies['logo']) }}" width="100px">
			@endisset
		 </div>
		 
	</div>
	<div class="form-group">
		 {{ Form::label('website', trans('labels.companies.website'), ['class' => 'col-lg-2 control-label required']) }}
		 <div class="col-lg-10">
		 	{{ Form::text('website', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.companies.website')]) }}
		 </div>
	</div>
</div>

@if(count($subCats)>0)

{!! Form::select('sub_cat_id',$subCats,[], ['placeholder' => 'Select Sub-Category','class' => 'form-control','required'=>true]) !!}

@if ($errors->has('sub_cat_id'))
    <span class="help-block">
        <strong class="text-danger">{{ $errors->first('sub_cat_id') }}</strong>
    </span>
@endif

    @else

    {!! Form::select('sub_cat_id',[],[], ['placeholder' => 'No Sub-Category','class' => 'form-control','required'=>false]) !!}

    @if ($errors->has('sub_cat_id'))
        <span class="help-block">
        <strong class="text-danger">{{ $errors->first('sub_cat_id') }}</strong>
    </span>
    @endif

@endif
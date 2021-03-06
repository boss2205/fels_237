@extends('layouts.layout')

@section('title')
    {{ trans('settings.title.manage_new_word') }}
@endsection

@section('content')      
    @if (!empty(session('status')))
        <div class="alert alert-{{ session('status') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('message') }}
        </div>
    @endif 
    <div class="panel panel-bordered panel-dark">
        <div class="panel-heading text-xs-center">
            <h3 class="panel-title">{{ trans('settings.title.manage_new_word') }}</h3>
        </div>
        <div class="panel-body">
            {{ Form::open([
                'class' => 'form-horizontal',
                'role' => 'form',
                'action' => 'Admin\WordController@store',
                'enctype' => 'multipart/form-data',
            ]) }}
                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                    {{ Form::select('category_id', $categories, null, [
                        'class' => 'form-control',
                        'id' => 'word_category',
                        'placeholder' => trans('settings.title.choice_category'),
                        'required',
                    ]) }}

                    @if ($errors->has('category_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('word') ? ' has-error' : '' }}">
                    {{ Form::text('word', old('word'), [
                        'class' => 'form-control',
                        'id' => 'nameWord',
                        'placeholder' => "Word",
                        'required',
                    ]) }}

                    @if ($errors->has('word'))
                        <span class="help-block">
                            <strong>{{ $errors->first('word') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    {{ Form::textarea('description', old('description'), [
                        'class' => 'form-control',
                        'id' => 'description',
                        'placeholder' => "Description",
                        'rows' => '3',
                    ]) }}

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <label for="basic-url">{{ trans('settings.layout.admin.answer') }}</label>                    
                <div class="form-group group-answer{{ $errors->has('check_answer') ? ' has-error' : '' }}">
                    @for ($i=0; $i < config('settings.number_answer'); $i++)
                        <div class="input-group m-b-5 input-answer">
                            <span class="input-group-addon">
                                {{ Form::radio('check_answer', $i, true) }}
                            </span>
                            {{ Form::text('answer[]', null, [
                                'class' => 'form-control',
                                'id' => 'answer_'.$i,
                                'required',
                                'autofocus',
                            ]) }}
                            <span class="input-group-btn">
                                {{ Form::button('<i class="fa fa-times" aria-hidden="true"></i>', [
                                    'class' => 'btn btn-danger p-t-10 delete-answer',
                                ]) }}
                            </span>
                        </div>
                    @endfor

                    @if ($errors->has('check_answer'))
                        <span class="help-block">
                            <strong>{{ $errors->first('check_answer') }}</strong>
                        </span>
                    @endif
                </div>

                <hr>
                {{ Form::submit(trans('settings.layout.admin.btn_addNew'), [
                    'class' => 'btn btn-primary',
                    'id' => 'addNewWord',
                ]) }}
                {{ Form::button(trans('settings.layout.admin.btn_addAnswer'), [
                    'class' => 'btn btn-success',
                    'id' => 'addAnswer',
                    'data-url' => action('Admin\WordController@wordContent'),
                ]) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection

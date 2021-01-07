@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('public.edit',['name'=> 'گارانتی']) ." - ". $warranty->name}}</div>
            <div class="card-body">
                {!! Form::model($warranty,['url' => route('admin.warranties.update',$warranty),'files'=>true]) !!}
                @csrf
                @method('PUT')
                <div class="form-group">

                    {{ Form::label('name', __('public.warranty name').':' ) }}
                    {{ Form::text('name',null,['class'=>"form-control "]) }}
                    @error('name')
                    <span class="has-error text-danger" >
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button class="btn btn-primary">{{  __('public.edit',['name'=> 'گارانتی']) }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

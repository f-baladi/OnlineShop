@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('public.edit',['name'=> 'رنگ']) ." - ". $color->name}}</div>
            <div class="card-body">
                {!! Form::model($color,['url' => route('admin.colors.update',$color),'files'=>true]) !!}
                @csrf
                @method('PUT')
                <div class="form-group">

                    {{ Form::label('name', __('public.color name').':' ) }}
                    {{ Form::text('name',null,['class'=>"form-control "]) }}
                    @error('name')
                    <span class="has-error text-danger" >
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">

                    {{ Form::label('code','کد رنگ : ') }}
                    {{ Form::color('code',null,['class'=>'form-control']) }}
                    @error('code')
                    <span class="has-error text-danger" >
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button class="btn btn-primary">{{  __('public.edit',['name'=> 'رنگ']) }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

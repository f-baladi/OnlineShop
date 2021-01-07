@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('partials.alert')
        <div class="card">
            <div class="card-header">{{ __('public.add new',['name'=> 'رنگ']) }}</div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.colors.store'),'files'=>true]) !!}
                @csrf
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

                <button class="btn btn-success">{{  __('public.create',['name'=> 'رنگ']) }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('partials.alert')
        <div class="card">
            <div class="card-header">{{ __('public.add new',['name'=> 'برند']) }}</div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.brands.store'),'files'=>true]) !!}
                @csrf
                <div class="form-group">

                    {{ Form::label('name', __('public.brand name').':' ) }}
                    {{ Form::text('name',null,['class'=>"form-control "]) }}
                    @error('name')
                    <span class="has-error text-danger" >
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">

                    {{ Form::label('image_title',__('public.image title').':') }}
                    {{ Form::text('image_title',null,['class'=>'form-control']) }}
                    @error('image_title')
                    <span class="has-error text-danger" >
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="file" name="image" id="image" onchange="loadFile(event)" style="display:none">
                    {{ Form::label('image', __('public.icon selection').':') }}
                    <img src="{{ url('pic_1.jpg') }}" onclick="select_file()" width="150" id="output">
                    @error('image')
                    <span class="has-error text-danger" >
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button class="btn btn-success">{{  __('public.create',['name'=> 'برند']) }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

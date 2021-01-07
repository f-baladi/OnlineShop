@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('public.edit',['name'=> 'برند']) ." - ". $brand->name}}</div>
            <div class="card-body">
                {!! Form::model($brand,['url' => route('admin.brands.update',$brand),'files'=>true]) !!}
                @csrf
                @method('PUT')
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

                <button class="btn btn-primary">{{  __('public.edit',['name'=> 'برند']) }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

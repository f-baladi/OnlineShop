@extends('layouts.admin')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">{{ __('public.add new category') }}</div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.categories.store'),'files'=>true]) !!}
                @csrf
                <div class="form-group">

                    {{ Form::label('title', __('public.category title').':' ) }}
                    {{ Form::text('title',null,['class'=>"form-control "]) }}
                    @error('title')
                    <span class="has-error text-danger" >
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">

                    {{ Form::label('english_title',__('public.category english title').':') }}
                    {{ Form::text('english_title',null,['class'=>'form-control']) }}
                    @error('english_title')
                    <span class="has-error text-danger" >
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                     {{ Form::label('parent_id', __('public.select the category head').':') }}
                     {{ Form::select('parent_id',$parent_cat,null,['class'=>'selectpicker auto_width','data-live-search'=>'true']) }}
                </div>

                <div class="form-group">
                    <input type="file" name="pic" id="pic" onchange="loadFile(event)" style="display:none">
                    {{ Form::label('pic', __('public.image selection').':') }}
                    <img src="{{ url('pic_1.jpg') }}" onclick="select_file()" width="150" id="output">
                    @error('pic')
                    <span class="has-error text-danger" >
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button class="btn btn-success">{{  __('public.create category') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
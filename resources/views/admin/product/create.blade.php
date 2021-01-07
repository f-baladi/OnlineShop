@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('partials.alert')
        <div class="card">
            <div class="card-header">{{ __('public.add new',['name'=> 'محصول']) }}</div>
            <div class="card-body">
                {!! Form::open(['url' =>  route('admin.products.store'),'files'=>true]) !!}

                <div class="form-group">

                    {{ Form::label('title',__('public.product title').':') }}
                    {{ Form::text('title',null,['class'=>'form-control total_width_input']) }}
                    @error('title')
                    <span class="has-error text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            {{ Form::label('english_title',__('public.product english title').':') }}
                            {{ Form::text('english_title',null,['class'=>'form-control left']) }}
                            @error('english_title')
                            <span class="has-error text-danger">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('category_id',__('public.select',['name' => 'دسته']).':') }}
                            {{ Form::select('category_id',$categories,null,['class'=>'selectpicker','data-live-search'=>'true']) }}
                            @error('category_id')
                            <span class="has-error text-danger">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('brand_id',__('public.select',['name' => 'برند']).':') }}
                            {{ Form::select('brand_id',$brands,null,['class'=>'selectpicker','data-live-search'=>'true']) }}
                            @error('brand_id')
                            <span class="has-error text-danger">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('status',__('public.status',['name' => 'محصول']).':') }}
                            {{ Form::select('status',['تعیین وضعیت','پیش نویس', 'در انتظار تایید', 'تایید', 'عدم تایید', 'ناموجود']
                                            ,null,['class'=>'selectpicker','data-live-search'=>'true']) }}
                            @error('status')
                            <span class="has-error text-danger">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">

                            {{ Form::label('description','توضیحات مختصر در مورد محصول : ',['style'=>'color:blue;width:100%']) }}
                            {{ Form::textarea('description',null,['class'=>'form-control','id'=>'description','style'=>'height:100px']) }}
                            @error('description')
                            <span class="has-error text-danger">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">

                            {{ Form::label('image_title',__('public.image title').':') }}
                            {{ Form::text('image_title',null,['class'=>'form-control left']) }}
                            @error('image_title')
                            <span class="has-error text-danger">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="file" name="image" id="image" onchange="loadFile(event)" style="display:none">
                        <div class="choice_pic_box" onclick="select_file()">

                            <span class="title">{{__('public.select',['name'=> 'تصویر محصول'])}}</span>
                            <img id="output" class="pic_tag">
                        </div>
                        @error('image')
                        <span class="has-error text-danger">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>

                <button class="btn btn-success">{{__('public.create',['name'=>'محصول'])}}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('partials.alert')
        <div class="card">
            <div class="card-header">{{ __('public.add new',['name'=> 'قیمت']) }}</div>
            <div class="card-body">
                {!! Form::open(['url' =>  route('admin.prices.store'),'files'=>true]) !!}

                <div class="col-md-6">
                <div class="form-group ">
                    {{ Form::label('product_id',__('public.select',['name' => 'محصول']).':') }}
                    {{ Form::select('product_id',$data['products'],null,['class'=>'selectpicker','data-live-search'=>'true']) }}
                    @error('product_id')
                    <span class="has-error text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    {{ Form::label('color_id',__('public.select',['name' => 'رنگ']).':') }}
                    {{ Form::select('color_id',$data['colors'],null,['class'=>'selectpicker','data-live-search'=>'true']) }}
                    @error('color_id')
                    <span class="has-error text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group">

                    {{ Form::label('price','قیمت محصول(قیمت به تومان وارد شود) : ',['style'=>'color:blue;width:100%;']) }}
                    {{ Form::text('price',null,['class'=>'form-control left price_input']) }}
                    @error('price')
                    <span class="has-error text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">

                    {{ Form::label('product_number','تعداد موجودی محصول  : ') }}
                    {{ Form::text('product_number',null,['class'=>'form-control left product_number']) }}
                    @error('product_number')
                    <span class="has-error text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">

                    {{ Form::label('max_number_order','حداکثر سفارش در سبد خرید  : ') }}
                    {{ Form::text('max_number_order',null,['class'=>'form-control left max_number_order']) }}
                    @error('max_number_order')
                    <span class="has-error text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button class="btn btn-success">{{__('public.create',['name'=>'قیمت'])}}</button>
                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/cleave.min.js') }}"></script>
    <script>

        var cleave1 = new Cleave('.price_input', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

        var cleave2 = new Cleave('.product_number', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave3 = new Cleave('.max_number_order', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

    </script>
@endsection

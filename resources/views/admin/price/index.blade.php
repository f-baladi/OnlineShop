@extends('layouts.admin')

@section('content')

    <div class="container">
        @include('partials.alert')
        @php $i=(isset($_GET['page'])) ? (($_GET['page']-1)*10): 0 ; @endphp
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                {{ __('public.manage',['name' => 'قیمت محصولات']) }}
                @include('partials.item_table',['count'=>$prices['trash_count'],'route'=>'admin/price','title'=>__('public.price')])
            </div>
            <div class="card-body">

                <form method="post" id="data_form">
                    @csrf
                    <table class="table table-bordered table-striped" style="text-align: center" id="price">
                        <thead>
                        <tr>
                            <th>{{__('public.row')}}</th>
                            <th>{{__('public.product title')}}</th>
                            <th>{{__('public.price')}}</th>
                            <th>{{__('public.color')}}</th>
                            <th>{{__('public.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prices['models'] as $price)
                            @php $i++; @endphp
                            <tr id="{{ $price->id }}">
                                <td>{{ ($i) }}</td>
                                <td style="max-width:180px">{{ $price->product->title }}</td>
                                <td style="width: 170px">
                                    <div  class="alert alert-success ">{{ number_format($price->price)}}
                                    <span class="m-1">{{'تومان'}}</span>
                                    </div>

                                </td>
                                <td>{{ $price->color->name }}</td>
                                <td>
                                    @if(!$price->trashed())
                                        <a href="{{route('admin.prices.edit',$price) }}">
                                            <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.edit',['name'=> 'محصول'])}}'
                                                class="fa fa-edit">
                                            </span>
                                        </a>
                                    @endif

                                    @if($price->trashed())
                                            <a href="{{route('admin.prices.restore',[$price->id]) }}">
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.restore',['name'=> 'محصول'])}}'
                                              onclick="return confirm('{{__('public.sure restore',['name'=> 'محصول'])}}')"
                                              class="fa fa-refresh">
                                        </span>
                                            </a>
                                    @endif

                                    @if(!$price->trashed())
                                            <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete',['name'=> 'محصول'])}}'
                                                  onclick="delete_row('{{route('admin.prices.destroy',$price)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'محصول'])}}')"
                                                  class="fa fa-remove">
                                            </span>
                                    @else
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete always',['name'=> 'محصول'])}}'
                                              onclick="delete_row('{{route('admin.prices.terminate',$price)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'محصول'])}}')"
                                              class="fa fa-remove">
                                        </span>
                                    @endif

                                </td>
                            </tr>

                        @endforeach
                        @if(sizeof($prices['models'])==0)
                            <tr>
                                <td colspan="5">{{__('public.no record')}}</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </form>
            </div>
            {{$prices['models'] -> links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection


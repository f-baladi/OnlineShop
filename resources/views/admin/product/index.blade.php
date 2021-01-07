@extends('layouts.admin')

@section('content')

    <div class="container">
        @include('partials.alert')
        @php $i=(isset($_GET['page'])) ? (($_GET['page']-1)*10): 0 ; @endphp
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                {{ __('public.manage',['name' => 'محصولات']) }}
                @include('partials.item_table',['count'=>$trash_product_count,'route'=>'admin/product','title'=>__('public.product')])
            </div>
            <div class="card-body">
                <form method="get" class="search_form">
                    @if(isset($_GET['trashed']) && $_GET['trashed']==true)
                        <input type="hidden" name="trashed" value="true">
                    @endif
                    <input type="text" name="string" class="form-control" value="{{ $request->get('string','') }}" placeholder="{{__('public.the word in question ...')}}">
                    <span class="m-2"></span>
                    <button class="btn btn-primary">{{__('public.search')}}</button>
                </form>
                <form method="post" id="data_form">
                    @csrf
                    <table class="table table-bordered table-striped" style="text-align: center">
                        <thead>
                        <tr>
                            <th>{{__('public.row')}}</th>
                            <th>{{__('public.product image')}}</th>
                            <th>{{__('public.product name')}}</th>
                            <th>{{__('public.status',['name' =>'محصول'])}}</th>
                            <th>{{__('public.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i}}</td>
                                <td><img src="{{$product->image->url}}" class="product_pic"></td>
                                <td>{{ $product->title }}</td>
                                <td style="width:130px">
                                        <span>
                                        {{ $product->status}}
                                    </span>
                                </td>
                                <td>
                                    @if(!$product->trashed())
                                        <a href="{{route('admin.products.edit',$product) }}">
                                            <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.edit',['name'=> 'محصول'])}}'
                                                  class="fa fa-edit">
                                            </span>
                                        </a>
                                    @endif

                                    @if($product->trashed())
                                        <a href="{{route('admin.products.restore',[$product->id]) }}">
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.restore',['name'=> 'محصول'])}}'
                                              onclick="return confirm('{{__('public.sure restore',['name'=> 'محصول'])}}')"
                                              class="fa fa-refresh">
                                        </span>
                                        </a>
                                    @endif

                                    @if(!$product->trashed())
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete',['name'=> 'محصول'])}}'
                                              onclick="delete_row('{{route('admin.products.destroy',$product)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'محصول'])}}')"
                                              class="fa fa-remove">
                                            </span>
                                    @else
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete always',['name'=> 'محصول'])}}'
                                              onclick="delete_row('{{route('admin.products.terminate',$product)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'محصول'])}}')"
                                              class="fa fa-remove">
                                        </span>
                                    @endif

                                </td>
                            </tr>

                        @endforeach
                        @if(sizeof($products)==0)
                            <tr>
                                <td colspan="5">{{__('public.no record')}}</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </form>
            </div>
            {{$products -> links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection


@extends('layouts.admin')

@section('content')

    <div class="container">
        @include('partials.alert')
        @php $i=(isset($_GET['page'])) ? (($_GET['page']-1)*10): 0 ; @endphp
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                {{ __('public.manage of brands') }}
                @include('partials.item_table',['count'=>$trash_brand_count,'title'=>__('public.brand')])
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
                            <th>{{__('public.brand name')}}</th>
                            <th>{{__('public.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            @php $i++; @endphp
                            <tr id="{{ $brand->id }}">
                                <td>{{ ($i) }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    @if(!$brand->trashed())
                                        <a href="{{route('admin.brands.edit',$brand) }}">
                                            <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.edit brand')}}'
                                                class="fa fa-edit">
                                            </span>
                                        </a>
                                    @endif

                                    @if($brand->trashed())
                                            <a href="{{route('admin.brands.restore',[$brand->id]) }}">
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.restore brand')}}'
                                              onclick="return confirm('{{__('public.sure restore')}}')"
                                              class="fa fa-refresh">
                                        </span>
                                            </a>
                                    @endif

                                    @if(!$brand->trashed())
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete brand')}}'
                                              onclick="delete_row('{{route('admin.brands.destroy',$brand)}}','{{ Session::token() }}','{{__('public.sure delete')}}')"
                                              class="fa fa-remove"></span>
                                    @else
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete brand always')}}'
                                              onclick="delete_row('{{route('admin.brands.terminate',$brand)}}','{{ Session::token() }}','{{__('public.sure delete')}}')"
                                              class="fa fa-remove"></span>
                                    @endif

                                </td>
                            </tr>

                        @endforeach
                        @if(sizeof($brands)==0)
                            <tr>
                                <td colspan="5">{{__('public.no record')}}</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </form>
            </div>
            {{$brands -> links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection


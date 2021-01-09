@extends('layouts.admin')

@section('content')

    <div class="container">
        @include('partials.alert')
        @php $i=(isset($_GET['page'])) ? (($_GET['page']-1)*10): 0 ; @endphp
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                {{ __('public.manage',['name' => 'رنگ ها']) }}
                @include('partials.item_table',['count'=>$colors['trash_count'],'title'=>__('public.color')])
            </div>
            <div class="card-body">
                <form method="get" class="search_form">
                    @if(isset($_GET['trashed']) && $_GET['trashed']==true)
                        <input type="hidden" name="trashed" value="true">
                    @endif
                    <input type="text" name="string" class="form-control" value="{{ $request->get('string','') }}"
                           placeholder="{{__('public.the word in question ...')}}">
                        <span class="m-2"></span>
                        <button class="btn btn-primary">{{__('public.search')}}</button>
                </form>
                <form method="post" id="data_form">
                    @csrf
                    <table class="table table-bordered table-striped" style="text-align: center">
                        <thead>
                        <tr>
                            <th>{{__('public.row')}}</th>
                            <th>{{__('public.color name')}}</th>
                            <th>{{__('public.color code')}}</th>
                            <th>{{__('public.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colors['models'] as $color)
                            @php $i++; @endphp
                            <tr id="{{ $color->id }}">
                                <td>{{ ($i) }}</td>
                                <td>{{ $color->name }}</td>
                                <td>
                                    <span class="color " style=" background:{{ $color->code }};@if($color->name=='سفید') color:#000000 @endif" >
                                        {{ $color->code }}
                                    </span>
                                </td>

                                <td>
                                    @if(!$color->trashed())
                                        <a href="{{route('admin.colors.edit',$color) }}">
                                            <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.edit',['name'=> 'رنگ'])}}'
                                                class="fa fa-edit">
                                            </span>
                                        </a>
                                    @endif

                                    @if($color->trashed())
                                            <a href="{{route('admin.colors.restore',[$color->id]) }}">
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.restore',['name'=> 'رنگ'])}}'
                                              onclick="return confirm('{{__('public.sure restore',['name'=> 'رنگ'])}}')"
                                              class="fa fa-refresh">
                                        </span>
                                            </a>
                                    @endif

                                    @if(!$color->trashed())
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete',['name'=> 'رنگ'])}}'
                                              onclick="delete_row('{{route('admin.colors.destroy',$color)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'رنگ'])}}')"
                                              class="fa fa-remove"></span>
                                    @else
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete always',['name'=> 'رنگ'])}}'
                                              onclick="delete_row('{{route('admin.colors.terminate',$color)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'رنگ'])}}')"
                                              class="fa fa-remove"></span>
                                    @endif

                                </td>
                            </tr>

                        @endforeach
                        @if(sizeof($colors['models'])==0)
                            <tr>
                                <td colspan="4">{{__('public.no record')}}</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </form>
            </div>
            {{$colors['models'] -> links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection


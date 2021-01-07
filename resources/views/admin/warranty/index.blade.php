@extends('layouts.admin')

@section('content')

    <div class="container">
        @include('partials.alert')
        @php $i=(isset($_GET['page'])) ? (($_GET['page']-1)*10): 0 ; @endphp
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                {{ __('public.manage',['name' => 'گارانتی ها']) }}
                @include('partials.item_table',['count'=>$trash_warranty_count,'title'=>__('public.warranty')])
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
                            <th>{{__('public.warranty name')}}</th>
                            <th>{{__('public.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($warranties as $warranty)
                            @php $i++; @endphp
                            <tr id="{{ $warranty->id }}">
                                <td>{{ ($i) }}</td>
                                <td>{{ $warranty->name }}</td>
                                <td>
                                    @if(!$warranty->trashed())
                                        <a href="{{route('admin.warranties.edit',$warranty) }}">
                                            <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.edit',['name'=> 'گارانتی'])}}'
                                                class="fa fa-edit">
                                            </span>
                                        </a>
                                    @endif

                                    @if($warranty->trashed())
                                            <a href="{{route('admin.warranties.restore',[$warranty->id]) }}">
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.restore',['name'=> 'گارانتی'])}}'
                                              onclick="return confirm('{{__('public.sure restore',['name'=> 'گارانتی'])}}')"
                                              class="fa fa-refresh">
                                        </span>
                                            </a>
                                    @endif

                                    @if(!$warranty->trashed())
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete',['name'=> 'گارانتی'])}}'
                                              onclick="delete_row('{{route('admin.warranties.destroy',$warranty)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'گارانتی'])}}')"
                                              class="fa fa-remove"></span>
                                    @else
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete always',['name'=> 'گارانتی'])}}'
                                              onclick="delete_row('{{route('admin.warranties.terminate',$warranty)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'گارانتی'])}}')"
                                              class="fa fa-remove"></span>
                                    @endif

                                </td>
                            </tr>

                        @endforeach
                        @if(sizeof($warranties)==0)
                            <tr>
                                <td colspan="4">{{__('public.no record')}}</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </form>
            </div>
            {{$warranties -> links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection


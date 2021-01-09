@extends('layouts.admin')

@section('content')

    <div class="container">
        @include('partials.alert')
        @php $i=(isset($_GET['page'])) ? (($_GET['page']-1)*10): 0 ; @endphp
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                {{ __('public.manage',['name' => 'دسته ها']) }}
                @include('partials.item_table',['count'=>$categories['trash_count'],'route'=>'admin/category','title'=>__('public.category')])
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
                            <th>{{__('public.category name')}}</th>
                            <th>{{__('public.parent category')}}</th>
                            <th>{{__('public.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories['models'] as $category)
                            @php $i++; @endphp
                            <tr id="{{ $category->id }}">
                                <td>{{ ($i) }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->getParent->title }}</td>
                                <td>
                                    @if(!$category->trashed())
                                        <a href="{{route('admin.categories.edit',$category) }}">
                                            <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.edit',['name'=> 'دسته'])}}'
                                                class="fa fa-edit">
                                            </span>
                                        </a>
                                    @endif

                                    @if($category->trashed())
                                            <a href="{{route('admin.categories.restore',[$category->id]) }}">
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.restore',['name'=> 'دسته'])}}'
                                              onclick="return confirm('{{__('public.sure restore',['name'=> 'دسته'])}}')"
                                              class="fa fa-refresh">
                                        </span>
                                            </a>
                                    @endif

                                    @if(!$category->trashed())
                                            <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete',['name'=> 'دسته'])}}'
                                                  onclick="delete_row('{{route('admin.categories.destroy',$category)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'دسته'])}}')"
                                                  class="fa fa-remove">
                                            </span>
                                    @else
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete always',['name'=> 'دسته'])}}'
                                              onclick="delete_row('{{route('admin.categories.terminate',$category)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'دسته'])}}')"
                                              class="fa fa-remove">
                                        </span>
                                    @endif

                                </td>
                            </tr>

                        @endforeach
                        @if(sizeof($categories['models'])==0)
                            <tr>
                                <td colspan="5">{{__('public.no record')}}</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </form>
            </div>
            {{$categories['models'] -> links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection


@extends('layouts.admin')

@section('content')

    <div class="container " >
        @include('partials.alert')
        @php $i=(isset($_GET['page'])) ? (($_GET['page']-1)*10): 0 ; @endphp
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                {{ __('public.manage',['name' => 'اسلایدر ها']) }}
                @include('partials.item_table',['count'=>$sliders['trash_count'],'title'=>__('public.slider')])
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
                            <th>{{__('public.slider title')}}</th>
                            <th>{{__('public.slider image')}}</th>
                            <th>{{__('public.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders['models'] as $slider)
                            @php $i++; @endphp
                            <tr id="{{ $slider->id }}">
                                <td >{{ ($i) }}</td>
                                <td>{{ $slider->title }}</td>
                                <td ><img src="{{$slider->url}}" class="slider_pic"></td>
                                <td>
                                    @if(!$slider->trashed())
                                        <a href="{{route('admin.sliders.edit',$slider) }}">
                                            <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.edit',['name'=> 'اسلایدر'])}}'
                                                class="fa fa-edit">
                                            </span>
                                        </a>
                                    @endif

                                    @if($slider->trashed())
                                            <a href="{{route('admin.sliders.restore',[$slider->id]) }}">
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.restore',['name'=> 'اسلایدر'])}}'
                                              onclick="return confirm('{{__('public.sure restore',['name'=> 'اسلایدر'])}}')"
                                              class="fa fa-refresh">
                                        </span>
                                            </a>
                                    @endif

                                    @if(!$slider->trashed())
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete',['name'=> 'اسلایدر'])}}'
                                              onclick="delete_row('{{route('admin.sliders.destroy',$slider)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'اسلایدر'])}}')"
                                              class="fa fa-remove"></span>
                                    @else
                                        <span data-toggle="tooltip" data-placement="bottom" title='{{__('public.delete always',['name'=> 'اسلایدر'])}}'
                                              onclick="delete_row('{{route('admin.sliders.terminate',$slider)}}','{{ Session::token() }}','{{__('public.sure delete',['name'=> 'اسلایدر'])}}')"
                                              class="fa fa-remove"></span>
                                    @endif

                                </td>
                            </tr>

                        @endforeach
                        @if(sizeof($sliders['models'])==0)
                            <tr>
                                <td colspan="5">{{__('public.no record')}}</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </form>
            </div>
            {{$sliders['models'] -> links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection


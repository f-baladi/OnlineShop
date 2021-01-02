@extends('layouts.admin')

@section('content')

    <div class="container">
        @include('partials.alert')
        @php $i=(isset($_GET['page'])) ? (($_GET['page']-1)*10): 0 ; @endphp
        <div class="card">
            <div class="card-header d-flex justify-content-between">{{ __('public.manage of categories') }}
                @include('partials.item_table',['count'=>$trash_cat_count,'route'=>'admin/category','title'=>'دسته'])
            </div>
            <div class="card-body">
                <form method="post" id="data_form">
                    @csrf
                    <table class="table table-bordered table-striped" style="text-align: center">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام دسته</th>
                            <th>دسته والد</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            @php $i++; @endphp
                            <tr id="{{ $category->id }}">
                                <td>{{ ($i) }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->getParent->title }}</td>
                                <td>
                                    @if(!$category->trashed())
                                        <a href="{{route('admin.categories.edit',$category) }}">
                                            <span
                                                class="fa fa-edit">
                                            </span>
                                        </a>
                                    @endif

                                    @if($category->trashed())
                                            <a href="{{route('admin.categories.restore',[$category->id]) }}">
                                        <span data-toggle="tooltip" data-placement="bottom" title='بازیابی دسته'
                                              onclick="return confirm('آیا از بازیابی این دسته مطمئن هستید ؟ ')"
                                              class="fa fa-refresh">
                                        </span>
                                            </a>
                                    @endif

                                    @if(!$category->trashed())
                                        <span data-toggle="tooltip" data-placement="bottom" title='حذف دسته'
                                              onclick="delete_row('{{route('admin.categories.destroy',$category)}}','{{ Session::token() }}','آیا از حذف این دسته مطمئن هستید ؟')"
                                              class="fa fa-remove"></span>
                                    @else
                                        <span data-toggle="tooltip" data-placement="bottom" title='حذف دسته برای همیشه'
                                              onclick="delete_row('{{route('admin.categories.terminate',$category)}}','{{ Session::token() }}','آیا از حذف این دسته مطمئن هستید ؟')"
                                              class="fa fa-remove"></span>
                                    @endif

                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </form>
            </div>
            {{$categories -> links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection


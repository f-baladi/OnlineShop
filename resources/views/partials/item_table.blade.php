<div class="dropdown">
    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{__('public.options')}}
    </button>
    <div class="dropdown-menu">

            <a class="dropdown-item" href="{{ url()->current().'/create' }}">
                <span class="fa fa-pencil"></span>
                <span>{{__('public.add')}} {{ $title }} {{__('public.new')}}</span>
            </a>

        <a class="dropdown-item" href="{{ url()->current().'?trashed=true' }}">
            <span class="fa fa-trash"></span>
            <span>{{__('public.recycle bin')}} ({{ $count }})</span>
        </a>

    </div>
</div>


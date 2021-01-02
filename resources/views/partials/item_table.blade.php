<div class="dropdown">
    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        گزینه ها
    </button>
    <div class="dropdown-menu">

            <a class="dropdown-item" href="{{ url()->current().'/create' }}">
                <span class="fa fa-pencil"></span>
                <span>افزودن {{ $title }} جدید</span>
            </a>

        <a class="dropdown-item" href="{{ url()->current().'?trashed=true' }}">
            <span class="fa fa-trash"></span>
            <span>سطل زباله ({{ $count }})</span>
        </a>

    </div>
</div>


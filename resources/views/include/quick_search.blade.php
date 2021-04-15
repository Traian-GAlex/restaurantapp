<form class="form-inline" action="{{Request::url()}}" method="get">
    @csrf
    <div class="input-group mb-3">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="q" name="q"
               value="{{Request::query('q')}}">
        <div class="input-group-append">
            <button class="btn btn-outline-info " type="submit">
                <i class="las la-search la-lg"></i>
            </button>
        </div>
    </div>

</form>

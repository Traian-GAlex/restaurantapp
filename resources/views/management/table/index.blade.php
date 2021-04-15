@extends("management.index")

@section("management")
    @component("include.index_content_header")
        @slot('title')
            <i class="las la-chair la-lg"></i>
            <span>Table</span>
        @endslot

        @slot('add_button')
            <a href="/management/table/create" class="btn btn-success btn-sm float-right">
                <i class="las la-plus la-lg"></i>
                <span>Add Table</span>
            </a>
        @endslot
    @endcomponent

    <hr>

    @if (count($tables) <= 0)
        <div class="alert alert-light" role="alert">
            <h4>There are no tables yet. Eating while standing is annoying!</h4>
        </div>
    @else

        @include("include.success_viewer")

        {{$tables->links()}}
        <table class="table table-sm table-striped table-hover">
            <thead class="bg-primary text-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Chairs</th>
                <th scope="col">Available</th>
                <th scope="col">View</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tables as $table)
                <tr>
                    <td style="width: 40px;" class="text-right align-middle">
                        <span class="">{{$table->id}}</span>
                    </td>
                    <td style="width: 75px;" class="align-middle">
                        <img class="img-thumbnail" width="70px" src="{{asset("/images/table_images/".$table->image)}}"
                             alt="{{$table->name}}">
                    </td>
                    <td class="align-middle">{{$table->name}}</td>

                    <td style="width: 32px;" class="align-middle">
                        <span>{{$table->chairs}}</span>
                    </td>

                    <td style="width: 32px; text-align: center" class="align-middle">
                        @if($table->available)
                            <span class="text-success">Yes</span>
                        @else
                            <span class="text-danger">No</span>
                        @endif
                    </td>

                    <td style="width: 32px;" class="align-middle">
                        <a class="btn btn-outline-success" href="/management/table/{{$table->id}}">
                            <i class="las la-search la-lg"></i>
                        </a>
                    </td>
                    <td style="width: 32px;" class="align-middle">
                        <a class="btn btn-outline-primary" href="/management/table/{{$table->id}}/edit">
                            <i class="las la-pencil-alt la-lg"></i>
                        </a>
                    </td>

                    <td style="width: 32px;" class="align-middle">
                        <form action="/management/table/{{$table->id}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Are you sure?')">
                                <i class="las la-trash la-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        {{$tables->links()}}

    @endif


@endsection

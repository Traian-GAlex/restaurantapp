@extends("management.index")

@section("management")

    @component("include.index_content_header")
        @slot('title')
            <i class="las la-align-justify la-lg"></i>
            <span>Category</span>
        @endslot

        @slot('add_button')
            <a href="/management/category/create" class="btn btn-success btn-sm float-right">
                <i class="las la-plus la-lg"></i>
                <span>Add Category</span>
            </a>
        @endslot
    @endcomponent

    <hr>

    @if(count($categories)<=0)
        <div class="alert alert-light" role="alert">
            <h4>There are no categories yet. Please add some...</h4>
        </div>
    @else

        @include("include.success_viewer")

        {{$categories->links()}}

        <table class="table table-sm table-striped table-hover">
            <thead class="bg-primary text-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td style="width: 40px;" class="text-right align-middle">
                        {{$category->id}}
                    </td>
                    <td class="align-middle">
                        <a href="{{ "/management/category/" . $category->id . "/edit" }}">{{$category->name}}</a>
                    </td>
                    <td style="width: 32px;" class="align-middle">
                        <a class="btn btn-outline-primary" href="/management/category/{{$category->id}}/edit">
                            <i class="las la-pencil-alt la-lg"></i>
                        </a>
                    </td>
                    <td style="width: 32px;" class="align-middle">
                        <form action="/management/category/{{$category->id}}" method="post">
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
        {{$categories->links()}}

    @endif

@endsection

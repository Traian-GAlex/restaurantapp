@extends("management.index")

@section("management")
    @component("include.index_content_header")
        @slot('title')
            <i class="las la-hamburger la-lg"></i>
            <span>Menu</span>
        @endslot

        @slot('add_button')
            <a href="/management/menu/create" class="btn btn-success btn-sm float-right">
                <i class="las la-plus la-lg"></i>
                <span>Add Menu</span>
            </a>
        @endslot
    @endcomponent

    <hr>

    @if (count($menus) <= 0)
        <div class="alert alert-light" role="alert">
            <h4>There is no menu yet. Hurry up, we are hungry!</h4>
        </div>
    @else

        @include("include.success_viewer")

        {{$menus->links()}}
        <table class="table table-sm table-striped table-hover">
            <thead class="bg-primary text-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">View</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td class="text-right align-middle">
                        <span class="">{{$menu->id}}</span>
                    </td>
                    <td style="width: 75px;" class="align-middle">
                        <img class="img-thumbnail" width="70px" src="{{asset("/images/menu_images/".$menu->image)}}"
                             alt="{{$menu->name}}">
                    </td>
                    <td class="align-middle">{{$menu->name}}</td>
                    <td class="text-right align-middle">{{$menu->price}}</td>
                    <td class="align-middle">
                        @if($menu->category_id == null)
                            &nbsp;
                        @else
                            {{$menu->category->name}}
                        @endif


                    </td>
                    <td style="width: 32px;" class="align-middle">
                        <a class="btn btn-outline-success" href="/management/menu/{{$menu->id}}">
                            <i class="las la-search la-lg"></i>
                        </a>
                    </td>
                    <td style="width: 32px;" class="align-middle">
                        <a class="btn btn-outline-primary" href="/management/menu/{{$menu->id}}/edit">
                            <i class="las la-pencil-alt la-lg"></i>
                        </a>
                    </td>

                    <td style="width: 32px;" class="align-middle">
                        <form action="/management/menu/{{$menu->id}}" method="post">
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
        {{$menus->links()}}

    @endif




@endsection

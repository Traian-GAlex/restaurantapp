<?php

?>
@extends("management.index")

@section("management")
    @component("include.index_content_header")
        @slot('title')
            <i class="las la-user la-lg"></i>
            <span>User</span>
        @endslot

        @slot('add_button')
            <a href="/management/user/create" class="btn btn-success btn-block float-right">
                <i class="las la-plus la-lg"></i>
                <span>Add user</span>
            </a>
        @endslot
    @endcomponent

    <hr>

    @if (count($users) <= 0)
        <div class="alert alert-light" role="alert">
            <h4>There are no users yet. Add some!</h4>
        </div>
    @else

        @include("include.success_viewer")

        {{$users->links()}}
        <table class="table table-sm table-striped table-hover">
            <thead class="bg-primary text-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">View</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td style="width: 40px;" class="text-right align-middle">
                        <span class="">{{$user->id}}</span>
                    </td>
                    <td style="width: 75px;" class="align-middle">
                        <img class="img-thumbnail" width="70px"
                             src="{{asset("/images/user_images/".$user->person->image)}}"
                             alt="{{$user->name}}">
                    </td>
                    <td class="align-middle">{{$user->getDisplayName()}}</td>

                    <td style="width: 32px;" class="align-middle">
                        <a class="btn btn-outline-success" href="/management/user/{{$user->id}}">
                            <i class="las la-search la-lg"></i>
                        </a>
                    </td>
                    <td style="width: 32px;" class="align-middle">
                        <a class="btn btn-outline-primary" href="/management/user/{{$user->id}}/edit">
                            <i class="las la-pencil-alt la-lg"></i>
                        </a>
                    </td>

                    <td style="width: 32px;" class="align-middle">
                        <form action="/management/user/{{$user->id}}" method="post">
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
        {{$users->links()}}

    @endif


@endsection

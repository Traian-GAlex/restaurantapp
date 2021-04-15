@extends("management.index")

@section("management")
    <br>
    <i class="las la-align-justify la-lg"></i>
    <span>Menu viewer</span>
    <hr>
    <div class="card">
        <img style="width: 18rem;" src="{{asset("/images/menu_images/". $menu->image)}}"
             class="card-img-top img-thumbnail mx-auto mt-3" alt="$menu->name">
        <div class="card-body">

            <div class="form-group">
                <label for="name">Menu name</label>
                <label class="form-control" id="name" name="name">{{$menu->name}}</label>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <label class="form-control text-right" id="price" name="price">{{$menu->price}}</label>
                </div>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                @if($menu->category_id == null)
                    <label class="form-control" id="category" name="category"></label>
                @else
                    <label class="form-control" id="category" name="category">{{$menu->category->name}}</label>
                @endif
            </div>

            <div class="form-group">
                <label for="description" style="display:block;">Description</label>
                @include("include.trix_editor", [
                            "id" => "x",
                            "name" => "description",
                            "value" => $menu->description,
                            "readonly" => true,
                        ])
            </div>

            <a href="/management/menu/{{$menu->id}}/edit" class="btn btn-primary float-right" type="submit">Edit</a>
        </div>
    </div>


@endsection


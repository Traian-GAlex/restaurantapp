@if (Route::has('login'))
        @auth
            <div class="col text-center">
            <a href="{{ url('/home') }}" class="btn btn-outline-light btn-block">Home</a>
            </div>
        @else
            <div class="col">
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-block">Login</a>
            </div>


            @if (Route::has('register'))
                <div class="col">
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-block">Register</a>
                </div>

            @endif
        @endauth
@endif

<div class="card" style="width: 18rem;">
    <img src="..." class="card-img-top" style="border-radius:50%;" width="100%" height="100%" alt="Card-ima-top">

    <ul class="list-group list-group-flush">
        <a href="{{route('home')}}" class="btn btn-primary btn-sm btn-block">Home</a>
        <a href="{{route('user-order')}}" class="btn btn-primary btn-sm btn-block">My Orders</a>
        <a class="btn btn-danger btn-sm btn-block" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </ul>

</div>
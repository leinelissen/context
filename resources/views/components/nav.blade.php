<nav>
    <div class="container">
        <div class="left">
            @if(!Request::is('/'))
                <a href="{{ URL::to('/') }}">
                    Back
                </a>
            @endif
        </div>
        <div class="middle">
            <img src="{{URL::to('images/context-white.svg')}}">
        </div>
        <div class="right">
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color:#e3484d;">
    <a class="navbar-brand" href="{{ url('/home') }}">
        <img src="{{ asset('images/Logo.jpg') }}" alt="" style="width: 150px; height: 50px; border-radius: 7px;">   
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/products/all') }}" style="color:white; font-size: 20px; font-weight: 500;">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('aboutus') }}" style="color:white; font-size: 20px; font-weight: 500;">About Us</a>
            </li>
        </ul>
    </div>
</nav>

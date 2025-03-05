<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="lecture1Dropdown" role="button">
                    Lecture 1
                </a>
                <ul class="dropdown-menu" aria-labelledby="lecture1Dropdown">
                    <li><a class="dropdown-item" href="{{ route('even') }}">Even Numbers</a></li>
                    <li><a class="dropdown-item" href="{{ route('prime') }}">Prime Numbers</a></li>
                    <li><a class="dropdown-item" href="{{ route('multable') }}">Multiplication Table</a></li>
                    <li><a class="dropdown-item" href="{{ route('mini-test') }}">Bill Information</a></li>
                    <li><a class="dropdown-item" href="{{ route('gpa') }}">GPA Task</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="lecture2Dropdown" role="button">
                    Lecture 2
                </a>
                <ul class="dropdown-menu" aria-labelledby="lecture2Dropdown">
                    <li><a class="dropdown-item" href="{{ route('products.index') }}">Products</a></li>
                    <li><a class="dropdown-item" href="{{ route('users.index') }}">Users</a></li>
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="">{{ auth()->user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger btn-m" href="{{ route('logout') }}">Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<style>
    /* Show dropdown on hover */
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }

    /* Ensure the dropdown stays visible */
    .nav-item .dropdown-toggle::after {
        display: none;
    }
</style>

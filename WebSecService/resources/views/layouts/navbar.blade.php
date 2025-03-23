<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>

            <!-- Lecture 1 Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="lecture1Dropdown" role="button">
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

            <!-- Lecture 2 Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="lecture2Dropdown" role="button">
                    Lecture 2
                </a>
                <ul class="dropdown-menu" aria-labelledby="lecture2Dropdown">
                    <li><a class="dropdown-item" href="{{ route('products.index') }}">Products</a></li>
                </ul>
            </li>

            <!-- Quizzes Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="quizzesDropdown" role="button">
                    Quizzes
                </a>
                <ul class="dropdown-menu" aria-labelledby="quizzesDropdown">
                    <li><a class="dropdown-item" href="{{ route('books.index') }}">Book Management</a></li>
                </ul>
            </li>
        </ul>

        <!-- User Dropdown -->
        <ul class="navbar-nav">
            @auth
                <li class="nav-item dropdown user-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end admin-dropdown" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('users.profile', auth()->user()->id) }}">Profile</a>
                        </li>

                        @can('show_users')
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-header">Access Control Panel</li>
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">User Access Control</a></li>
                            <li><a class="dropdown-item" href="{{ route('roles.index') }}">Roles Management</a></li>
                            <li><a class="dropdown-item" href="{{ route('permissions.index') }}">Permissions Management</a>
                            </li>
                        @endcan

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
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

<!-- Styles -->
<style>
    /* Show dropdown on hover for Lecture 1, Lecture 2, and Quizzes */
    .navbar-nav .dropdown:not(.user-dropdown):hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    .dropdown-menu {
        transition: all 0.3s ease-in-out;
        min-width: 200px;
        z-index: 1050;
    }

    .admin-dropdown {
        right: 0 !important;
        left: auto !important;
        transform: translateX(-10px);
    }

    /* Ensure dropdowns close properly */
    .dropdown-menu-end {
        right: 0;
        left: auto;
    }

    /* Fix user dropdown not working fully */
    .user-dropdown:hover .dropdown-menu {
        display: block;
    }
</style>

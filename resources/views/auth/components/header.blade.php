<div class="header border-bottom">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        Dashboard
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Hello, {{ auth()->user()->nama }}
                        </a>
                        <div class="dropdown custom-dropdown">
                            <div data-bs-toggle="dropdown" style="height: 50px">
                            </div>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="/{{ auth()->user()->username }}/edit">Profile</a>
                                <form id="logout-form" action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item header-profile ms-0">
                        <a class="nav-link">
                            <img src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : '/admin/images/user.png' }}"
                                width="56" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 border-radius-xl shadow-none position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky"
     navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <div class="d-flex flex-row">
                <div class="my-auto me-3">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </div>
                <div>
                    @stack('breadcrumbs')
                </div>
            </div>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                {{-- --}}
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0 d-flex flex-row" id="dropdownMenuButton"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-circle cursor-pointer me-2 my-auto" style="color: #59F30D"></i>
                        <span class="font-weight-bold my-auto d-none d-xl-block">{{Auth::user()->email }}</span>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end px-2 py-1 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto me-3">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-sm m-0 p-0">
                                                <span class="font-weight-bold">Log Out</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

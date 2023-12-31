<div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{route('home.shop')}}" class="nav-item nav-link">Home</a>
                            <a href="{{route('shop.product')}}" class="nav-item nav-link active">Shop</a>
                        @foreach($menus as $menuItem)
                            <div class="nav-item dropdown">
                            
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{$menuItem->name}}</a>
                                
                               
                                <div class="dropdown-menu rounded-0 m-0">
                                    @foreach($menuItem->menuChirld as $menuChild)
                                    <a href="cart.html" class="dropdown-item">{{$menuChild->name}}</a>
                                 
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                          
                        </div>
                   @if(Session::get('id_user'))
                        <div class="navbar-nav ml-auto py-0">
                            <a href="" class="nav-item nav-link">{{Session::get('name')}}</a>
                            <a href="{{route('logout')}}" class="nav-item nav-link">Logout</a>
                        </div>
                 @else
                        <div class="navbar-nav ml-auto py-0">
                            <a href="{{route('login.user')}}" class="nav-item nav-link">Login</a>
                            <a href="{{route('dangki.user')}}" class="nav-item nav-link">Register</a>
                        </div>
                        @endif
                    </div>
                </nav>
            </div>
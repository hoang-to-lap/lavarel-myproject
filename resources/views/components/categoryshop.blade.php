<div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    @foreach($categories as $categoryItem)
                        <div class="nav-item dropdown">
                     
                            <a href="{{route('shop.productofcategory',['slug' => $categoryItem->slug , 'id' => $categoryItem->id ])}}" class="nav-link" data-toggle="dropdown" >{{$categoryItem->name}} 
                                
                         
                            <i class="fa fa-angle-down float-right mt-1  "></i></a>
                           
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            @foreach($categoryItem->categoryChirld as $categoryChild)
                                <a href="{{route('shop.productofcategory',['slug' => $categoryChild->slug , 'id' => $categoryChild->id ])}}" class="dropdown-item">{{$categoryChild->name}}</a>
                                @endforeach
                            </div>
                       
                        </div>
                        @endforeach  
                        <!-- <a href="" class="nav-item nav-link">Shirts</a>
                        <a href="" class="nav-item nav-link">Jeans</a>
                        <a href="" class="nav-item nav-link">Swimwear</a>
                        <a href="" class="nav-item nav-link">Sleepwear</a>
                        <a href="" class="nav-item nav-link">Sportswear</a>
                        <a href="" class="nav-item nav-link">Jumpsuits</a>
                        <a href="" class="nav-item nav-link">Blazers</a>
                        <a href="" class="nav-item nav-link">Jackets</a>
                        <a href="" class="nav-item nav-link">Shoes</a> -->
                    </div>
                </nav>
            </div>
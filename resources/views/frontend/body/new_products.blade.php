
@php
$categories = App\Models\Category::get();
$products = App\Models\Product::where('status','1')->get();

     @endphp



<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">New Products</h3>

            
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
              <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
              @foreach($categories as $category)
              <li><a data-transition-type="backSlide" href="#smartphone" data-toggle="tab">{{$category->category_name}}</a></li>
              @endforeach
            </ul>
            <!-- /.nav-tabs -->
            

          </div>

          
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                @foreach($products as $product)
                
                <div class="item item-carousel">


                  
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a href="detail.html"><img  src="{{asset($product->product_thambnail)}}" alt=""></a> </div>
                          <!-- /.image -->
                          
                          <div class="tag new"><span>new</span></div>
                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                          <h3 class="name"><a href="detail.html">{{$product->product_name}}</a></h3>
                          <div class="rating rateit-small"></div>
                          <div class="description"></div>
                          <div class="product-price">

                          @php
        $amount = $product->selling_price - $product->discount_price;
        $discount = ($amount/$product->selling_price) * 100;
        @endphp                  

        @if($product->	discount_price == NULL)

                          <span class="price">${{$product->selling_price}}</span> 

                             
                            @else
                            <span class="price"> ${{$product->discount_price}} </span> 
                             <span class="price-before-discount">${{$product->selling_price}}</span>

                            @endif
                            </div>


                          <!-- /.product-price --> 
                          
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">
                                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                              </li>
                              <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                              <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                            </ul>
                          </div>
                          <!-- /.action --> 
                        </div>
                        <!-- /.cart --> 
                      </div>
                      <!-- /.product --> 
                   

                    </div>
                    <!-- /.products --> 
                
                  </div>
                  <!-- /.item -->
                  @endforeach
                  <!-- /.item -->
                  

                  <!-- /.item -->
                  
                  
                  <!-- /.item -->
                  
                 
                  <!-- /.item -->
                  

                  <!-- /.item --> 
                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            <!-- /.tab-pane -->
            

            <!-- /.tab-pane -->
            
           
            <!-- /.tab-pane -->
            
          
            <!-- /.tab-pane --> 
            
          </div>
          <!-- /.tab-content --> 
        </div>
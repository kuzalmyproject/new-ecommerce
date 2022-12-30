
@php
$featured_products = App\Models\Product::where('featured',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->get();
     @endphp



<section class="section featured-product wow fadeInUp">
          <h3 class="section-title">Featured products</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
          
          @foreach($featured_products as $product)
          <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">

               
                    <div class="image"> <a href="detail.html"><img  src="{{asset($product->product_thambnail)}}" alt=""></a> </div>
                    <!-- /.image -->
                    
                    <div class="tag hot"><span>hot</span></div>
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name"><a href="detail.html">{{$product->product_name}}</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="description"></div>
                    <div class="product-price"> <span class="price"> ${{$product->discount_price}} </span> <span class="price-before-discount">${{$product->selling_price}}</span> </div>
                    <!-- /.product-price --> 
                    
                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                          <button class="btn btn-primary icon" data-="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                          <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </li>
                        <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                        <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                      </ul>



                    </div>
                    <!-- /.action --> 


                    
                  </div>toggle
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
        </section>
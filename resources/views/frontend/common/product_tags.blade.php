@php
$product_tags = App\Models\Product::groupby('product_tags')->select('product_tags')->get();
     @endphp


<div class="sidebar-widget product-tag wow fadeInUp">


          <h3 class="section-title">Product tags</h3>

          
          <div class="sidebar-widget-body outer-top-xs">
            <div class="tag-list">
            @foreach($product_tags as $product)
                 <a class="item" title="Phone" href="category.html">{{$product->product_tags}}</a> 
                 @endforeach
           
                </div>
            <!-- /.tag-list --> 
          </div>

         
          <!-- /.sidebar-widget-body --> 
        </div>

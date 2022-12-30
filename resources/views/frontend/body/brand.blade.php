@php
$brands = App\Models\Brand::get()->all();
     @endphp



<div id="brands-carousel" class="logo-slider wow fadeInUp">
      <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
         @foreach($brands as $brand)
        
        <div class="item m-t-15"> <a href="#" class="image"> <img data-echo="{{ asset($brand->brand_image)}}" src="{{ asset($brand->brand_image)}}" alt="" width="50px"> </a> </div>
          <!--/.item-->
          
         @endforeach
        </div>
        <!-- /.owl-carousel #logo-slider --> 
      </div>
      <!-- /.logo-slider-inner --> 
      
    </div>
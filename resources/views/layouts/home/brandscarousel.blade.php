

  @if ($site_setting->vendors)
      </div>
  @endif
  <div class="container mt-3">
      <a href="{{ route('brands.homeIndex') }}" class="title-brand ">
          <h2 class="text-center" style=" font-family:'dastnevis' !important;">برند ها</h2>
      </a>
      <div class="owl-carousel row loop  brandCarosal ">

          @foreach ($brands as $brand)
              <a href="{{ route('showByBrand', ['brand' => $brand->slug]) }}" class="brandCard brand-img-shake-hover ">

                  <div style="    display: grid;
                    align-items: center;" class="h-120 ">
                      <img style=" width:150px; height:100%; margin:0px auto; object-fit: center; " class="image-fluid"
                          src="{{ url(env('BRAND_ICON_UPLOAD_PATH') . $brand->icon_name) }}" alt="">
                  </div>

                  <h4 class="iransansmedium" style=" text-align: center; color:black; font-size:12px ; ">
                      {{ $brand->name }}

                  </h4>


              </a>
          @endforeach
      </div>

  </div>

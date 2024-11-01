<div class="container ">

    <div class="row justify-content-center">
        <div class="text-center">

         <a href="{{ route('user.favorites.products') }}">
        <button type="button" class="btn btn-outline-primary btn-lg mt-2">محصولات</button>
        </a>
 
        {{-- <a style="font-size: 15px;" href="{{ route('user.favorites.products') }}" class="first text-center  favoriteLink  instarang  col-xs-12 col-md-3 my-1">


            <h4> <strong>

                محصولات

                </strong>

                (
                    {{ count($products) }}
                )
            </h4>

        </a>
      --}}
 
      <a href="{{ route('user.favorites.vendors') }}">
      <button type="button" class="btn btn-outline-primary btn-lg mt-2" >فروشگاه ها</button>
      </a>

        {{-- <a href="{{ route('user.favorites.vendors') }}" class="first text-center  favoriteLink  instarang  col-xs-12 col-md-3 mb-1 my-1">


            <h4> <strong>

                    فروشگاه ها

                </strong>

                (
                {{ count($vendors) }}
                )

            </h4>

        </a> --}}
      
           <a href="{{ route('user.favorites.articles') }}"  >
            <button type="button" class="btn btn-outline-primary btn-lg mt-2">مقاله ها </button>
            </a>
      
        {{-- <a href="{{ route('user.favorites.articles') }}" class="first text-center  favoriteLink  instarang  col-xs-12 col-md-3 my-1 ">


            <h4> <strong>

                مقاله ها
            </strong>

                (
                {{ count($Articles) }}
                )

            </h4>

        </a> --}}
     
           {{--  <a href="{{ route('user.favorites.stories') }}" >
            <button type="button" class="btn btn-outline-primary btn-lg mt-2" >استوری ها</button>
            </a>
         --}}
   
        {{-- <a href="{{ route('user.favorites.stories') }}" class="first text-center  favoriteLink  instarang  col-xs-12 col-md-3 my-1">


            <h4> <strong>

                استوری ها

                </strong>

                (
                {{ count($stories) }}
                )

            </h4>

        </a> --}}
    </div>
</div>
</div>

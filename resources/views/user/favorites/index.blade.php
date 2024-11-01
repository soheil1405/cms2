@extends('user.layouts.user')

@section('title')
    index products
@endsection



<style>
    .instarang {
        background: radial-gradient(ellipse at 70% 70%, #ee583f 8%, #d92d77 42%, #bd3381 58%);
    }

    .favoriteLink {
        color: #ffff !important;
        border-radius: 10px;
        width: 20%;
        height: 100%;
        padding: 10px;

        text-decoration: none;
    }

    
</style>

@section('content')
    <div class="container text-center">

        <div class="row   text-center ">


            
            <a href="{{ route('favorite.products') }}" class="first text-center  favoriteLink  instarang  ">


                <h4> <strong>

                    محصولات

                    </strong>

                    (
                        {{ count($products) }}
                    )
                </h4>

            </a>
       

            <a href="{{ route('favorite.vendors') }}" class="first text-center  favoriteLink  instarang  ">


                <h4> <strong>

                        فروشگاه ها

                    </strong>

                    (
                    {{ count($vendors) }}
                    )

                </h4>

            </a>

            <a href="{{ route('favorite.articles') }}" class="first text-center  favoriteLink  instarang  ">


                <h4> <strong>

                    مقاله ها
                </strong>

                    (
                    {{ count($Articles) }}
                    )

                </h4>

            </a>
            <a href="{{ route('favorite.stories') }}" class="first text-center  favoriteLink  instarang  ">


                <h4> <strong>

                    استوری ها

                    </strong>

                    (
                    {{ count($stories) }}
                    )

                </h4>

            </a>
        </div>
    </div>
@endsection

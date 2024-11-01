
<div class="col-12 col-md-6">

    
    <a href="{{$href}}"
        class="bg-secondary-subtle text-black rounded   mx-auto row post-card"
        style="box-shadow: 1px 1px 13px 3px #444444ba;">
        <div class="col-md-4 col-6 p-md-3 p-2">
            <h3 class="h5 post-title-font-size">

                {{-- {{ Str::limit($article->title, 30) }} --}}


                @if ($article->name)
                    
                {{ $article->name }}

                @else

                {{ $article->title }}


                @endif

            </h3>
            <hr>
            <p class="py-2 post-body-font-size">




                
                @if ($article->pre_show)
                    
                    {!! Str::limit(strip_tags($article->pre_show), 120) !!}

                @else

                    {!! Str::limit(strip_tags($article->body), 120) !!}

                @endif
            </p>
        </div>
        <div class="col-md-8 col-6 row m-0 ">
            <div class=" row m-0  px-md-4 px-1 article-card-img">

                
        @php
            
        if(is_null($article->main_img) && is_null($article->image)    ){
            $asset = asset(env('ARTICLE_IMAGES_UPLOAD_PATH') . \App\Models\Admin\Setting::select('userArticelDefualtImg')->first()->userArticelDefualtImg) ;
        }elseif(!is_null($article->main_img)){    
            $asset = asset(env('ARTICLE_IMAGES_UPLOAD_PATH') . $article->main_img);  
        }else{
            $asset = asset(env('ARTICLE_IMAGES_UPLOAD_PATH') . $article->image);   
        }



        @endphp 
        <img  src="{{$asset}}"  alt="{{$asset}}" class=" rounded p-0" style="margin-top: -30px; object-fit: cover;box-shadow: 1px 1px 13px 3px #444444ba;">


        
        
        </div>
            <div class="row gy-2 py-2 mt-1 align-self-end post-texts   m-0 ">

                <div class="col-md-6 col-12 d-flex justify-content-evenly  align-items-end">

                    {{--  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        style="color: #000;" class="bi bi-heart Seticonsingleproduct" viewBox="0 0 16 16">
                        <path
                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z">
                        </path>
                    </svg>  --}}
                    <img width="25" height="25"
                        src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/external-send-email-flatart-icons-outline-flatarticons.png"
                        alt="external-send-email-flatart-icons-outline-flatarticons" />
                </div>
                <div class="col-md-6 col-12 text-mob-center ">
                    <span class="create-date-post ">
                        {{ jdate($article->created_at)->format('%d %B %Y') }}

                    </span>
                </div>
            </div>
        </div>
    </a>
</div>

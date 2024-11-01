@extends('admin.layouts.admin')

@section('title')
    index brands
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0"> 
                
                    
                     پبش نمایش مقاله : 

                     
                </h5>
 




        <div class="">
            <a class="btn btn-primary" href="{{ route('admin.articles.edit' ,['article'=> $article] ) }}">
                ویرایش مقاله
            </a>
        </div>

                
            </div>

            <br>

            <?php $link = env('ARTICLE_IMAGES_UPLOAD_PATH') . $article->main_img;
            
            $link2 = asset($link);
            
            ?>
            
                    

            <div style="display: flex; margin-bottom: 30px;">
            

            
                <img src="{{ $link }}" style="width: 100px; height:100px; border-radius: 50%;"  alt="">
                <h1 class="text-center" style="color: black; padding:20px;" >{{ $article->title }}</h1>
            
            </div>


        {!! $article->body !!}
            



        </div>
    </div>
@endsection

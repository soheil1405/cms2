
@extends('admin.layouts.admin')

@section('title')
    
@endsection

@section('content')





                    
                <h4> <a > گیف  1  </a></h4>
                    <img class="brd25 " style="width: 60px" src="{{ url(env('HOME_GIFS_DIRECTORY') . $setting->gif1) }}" alt="">
                    <form id="gif1form" action="{{route('admin.settindDetail.updateGif1')}}" method="post" enctype="multipart/form-data">
                            
                        @csrf

                        
                       <label>لینک:</label>


<input type="text" name="gif1Link" value="{{$setting->gif1Link}}" class="form-control">


                        <input type="file" name="gif1" class="form-control" onchange="$('#gif1form').submit();" >
            

                        <h4> <a > گیف 2  </a></h4>
               
<img class="brd25 " style="width: 60px" src="{{ url(env('HOME_GIFS_DIRECTORY') . $setting->gif2) }}" alt="">

@csrf
                       <label>لینک:</label>


                       <input type="text" name="gif2Link" value="{{$setting->gif2Link}}" class="form-control">
                        <input type="file" name="gif2"  class="form-control" onchange="$('#gif11form').submit();" >

                        <input type="submit" value="ثبت" name="submitBt" class="btn btn-success"    >

                    </form>
            

@endsection



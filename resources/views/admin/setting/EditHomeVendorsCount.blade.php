
@extends('user.layouts.user')

@section('title')
    
@endsection

@section('content')





<form action="" method="post">
    @csrf


    <div class="form-group">
        <label for="">محصولات ویژه</label>
        <input type="number" name="SpecialPcount" id="" value="{{$setting->SpecialPcount}}">
    </div>


    <div class="form-group">
        <label for=""> محصولات پربازدید</label>
        <input type="number" name="MostViewProduct" id="" value="{{$setting->MostViewProduct}}">
    </div>


    <div class="form-group">
        <label for="">محصولات محبوب</label>
        <input type="number" name="PopularPCount" id="" value="{{$setting->PopularPCount}}">
    </div>


    <div class="form-group">
        <label for="">فروشگاه های ویژه</label>
        <input type="number" name="SpecialPcount" id="" value="{{$setting->SpecialVCount}}">
    </div>


    <div class="form-group">
        <label for=""> فروشگاه های پر محصول</label>
        <input type="number" name="MostViewProduct" id="" value="{{$setting->SpecialVCount}}">
    </div>


    <div class="form-group">
        <label for="">فروشگاه های محبوب</label>
        <input type="number" name="PopularPCount" id="" value="{{$setting->PopularVCount}}">
    </div>


</form>




           
<input type="submit" value="تایید" class="btn btn-primary">








@endsection



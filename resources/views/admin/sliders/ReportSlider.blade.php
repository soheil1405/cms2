



@extends('admin.layouts.admin')

@section('title')
    edit products
@endsection

@section('script')

@endsection

@section('content')





<div class="row">

            <form  action="{{route('admin.SendWarningMassageToVendor')}}" method="POST">

                @csrf
                

                <label for="">  دلیل رد شدن اسلایدر</label>

                <select name="reason" id="">
                    <option value="laws">عدم رعایت قوانین و مقررات</option>
                    <option value="pic"> تصاویر نامربوط </option>
                </select>

                <input type="hidden" name="subject" value="slider">
                <input type="hidden" name="subjectId" value="{{$slider->id}}">
               


                <br><br><br><br>

                
                <div class="" style="display: flex;">
                    <textarea   name="msg" id="" placeholder="در صورت نیاز پیام مورد نظر خود را وارد کنید "  cols="80" rows="10"></textarea>
                </div>
               
                <input type="submit" id="ReportSubmit"  value="ریپورت" name="report">
            </form>
        </div>
@endsection
            
            
            
            
            
            
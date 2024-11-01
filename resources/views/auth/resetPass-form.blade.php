@extends('user.layouts.user')

@section('title')
    index products
@endsection





@section('content')
    <div class="row">
        <h1>لطفا رمز جدید خود را وارد کنید </h1>



        <form action="{{ route('user.final_reset_pass') }}" style="display: flex; flex-direction: column;" method="post">


            @csrf
            <div class="">

                <label for="password">رمزعبور جدید :</label>
                <input type="text" class="form-control" name="password" id="password">

            </div>

            <div class="">
                <label for="password_verify">تکرار رمزعبور :</label>
                <input type="text"  class="form-control" name="password_verify" id="password_verify">


            </div>

            <div class="">
                <button type="submit" class="form-control">تایید</button>


            </div>
        </form>



    </div>
@endsection

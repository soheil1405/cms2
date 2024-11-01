@extends('user.layouts.user')

@section('title')
    کارمندان
@endsection





@section('content')
    <h1>افزودن کاربر جدید</h1>


    <form action="{{ route('user.Employees.store') }}" method="post">


        @csrf


        <div class="row">

            <div class=" col-3 p-1">
                <label for="">نام کاربر</label>
                <input type="text" name="name" class="form-control" id="" required>
            </div>

            <div class=" col-3 p-1 ">
                <label for="">شماره تلفن </label>
                <input type="number" value="{{ old('number') }}" name="number" class="form-control"
                    id=""required>



                @if (Session::has('NumberErr'))
                    <span class="text-danger">{{ Session::get('NumberErr') }}</span>
                @endif

            </div>


            <div class="col-3 p-1">
                <label for="">پسورد</label>
                <input type="text" name="pass" class="form-control" id="" required>
            </div>
            <div class="col-3 p-1">
                <label for="">نکرار پسورد</label>
                <input type="text" name="repass" class="form-control" id="" required>
            </div>


        </div>


        <hr>


        <div class="row">
            <div class="col-3  ">


                <input type="checkbox" id="addsAll" onchange="selectAll();" name="addsAll">


                <label for="addsAll">تبلیغات</label>


                <div class="col-12 border border-secondary" style="height:300px; overflow-y: scroll;">
                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="newS" id="newS">


                        <label for="newS">ارسال استوری</label>

                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="newSpcV" id="newSpcV">


                        <label for="newSpcV">ارسال فروشگاه به صفحه اول</label>

                    </div>

                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="SendSlider" id="SendSlider">


                        <label for="SendSlider">ارسال اسلایدر</label>

                    </div>

                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="newSpcP" id="newSpcP">


                        <label for="newSpcP">ارسال محصول به صفحه اول</label>

                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="ladderP" id="ladderP">


                        <label for="ladderP">نردبان محصول</label>

                    </div>

                    <div class="form-group">
                        <input type="checkbox" class="Addddd" name="ladderV" id="ladderV">


                        <label for="ladderV">نردبان فروشگاه</label>

                    </div>




                </div>

            </div>

            <div class="col-3 ">

                <input type="checkbox" name="productsAll" id="productsAll" onchange="selectAll('ap')" id="">


                <label for="productsAll">محصولات</label>


                <div class="col-12 border border-secondary" style="height:300px; overflow: scroll;">

                    <div class="form-group">
                        <input type="checkbox" name="newp" id="newp">


                        <label for="newp">افزودن محصول جدید</label>

                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="editp" id="editp" id="">


                        <label for="editp">ویرایش محصول</label>

                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="deletep" id="deletep">


                        <label for="deletep">حذف محصول</label>

                    </div>

                </div>

            </div>

            <div class="col-3 ">





                <label for="productsAll">سایر موارد</label>
                <br>
                <div class="col-12 border border-secondary" style="height:300px;">
                    <div class="form-group">
                        <input type="checkbox" name="editV" id="editV">


                        <label for="editV">ویرایش اظلاعات فروشگاه</label>

                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="TicketController" id="TicketController">


                        <label for="TicketController">دسترسی به تیکت ها</label>

                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="commentController" id="commentController">


                        <label for="commentController">مدیریت دیدگاه ها</label>

                    </div>
                </div>


            </div>


            <div class="col-3 p-1">
                <label for="">حداکثر مبلغ قابل استفاده از کیف پول </label>
                <input type="numner" name="maxUseMoney" class="form-control" id="">

                تومان

                @if (Session::has('notEnoghMoney'))
                    <span class="text-danger">
                        {{ Session::get('notEnoghMoney') }}
            </div>
            @endif
        </div>
        
        </div>




        <input type="submit" value="ثبت کاربر" class="btn btn-info">


        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif

    </form>
@endsection



<script>
    function selectAll() {


        var btn = $('#addsAll');

        if (!$('input:checkbox').is('checked')) {
            console.log('checked');
        } else {
            console.log('0');

        }

    }
</script>

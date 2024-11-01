@extends('admin.layouts.admin')

@section('title')
    افزودن ادمین جدید
@endsection

<style>
    .sdsdsd {
        display: none;
    }
</style>



@section('content')
    <h1>افزودن کاربر جدید</h1>


    <form action="{{ route('admin.admins.store') }}" method="post">


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

            <label for="show1" onclick="$('#custom').css('display' , 'none'); show1()">انتخاب سطح دسترسی</label>
            <input type="radio" name="accc" value="lvl" id="show1" checked />

            <label for="show2" onclick="$('#custom').css('display' , 'block');  show2()">انتخاب custom</label>
            <input type="radio" name="accc" value="custom"id="show2" />



        </div>


        <div class=" sdsdsd" id="custom">


            <div class="row">
                <div class="form-group  m-3">
                    <input type="checkbox" class="Addddd" checked name="dashboard" id="dashboard">
                    <label for="dashboard">صفحه اصلی داشبرد ادمین ها</label>
                </div>
    
    
    
    
                <div class="col-12">
    
    
                    <label for="">فروشگاه ها</label>
    
                    <hr>
                </div>
                {{--  --}}
                <div class="form-group  m-3">
                    <input  type="checkbox" class="individual" name="Allvendors" id="Allvendors">
                    <label for="Allvendors">همه فروشگاه ها</label>
                </div>
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="ladderV" id="ladderV">
                    <label for="ladderV">نردبان فروشگاه</label>
                </div>
    
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="editVPage" id="editVPage">
                    <label for="editVPage"> صفحه ویرایش اظلاعات فروشگاه </label>
                </div>
    
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="editV" id="editV">
                    <label for="editV">ویرایش اظلاعات فروشگاه</label>
                </div>
                <div class="form-group  m-3">
                    <input type="checkbox" name="acceptVendor" id="acceptVendor" id="">
                    <label for="acceptVendor">تایید فروشگاه</label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="showVendor" id="showVendor" id="">
                    <label for="showVendor"> نمایش فروشگاه</label>
                </div>
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="newSpcV" id="newSpcV">
                    <label for="newSpcV">ارسال فروشگاه به حالت ویژه</label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="AllSpcVendors" id="AllSpcVendors" id="">
                    <label for="AllSpcVendors"> صفحه فروشگاه های ویژه</label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="dltSpcVendor" id="dltSpcVendor" id="">
                    <label for="dltSpcVendor" class="text-danger"> حدف فروشگاه از حالت ویژه</label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="deleteV" id="deleteV">
                    <label for="deleteV" class="text-danger"> حدف فروشگاه</label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="deleteVPage" id="deleteVPage">
                    <label for="deleteVPage" class="text-danger"> صفحه حذف فروشگاه</label>
                </div>
    
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="VendorEditList"
                        id="VendorEditList">
                    <label for="VendorEditList" class="text-danger"> صفحه لیست تغییرات فروشگاه ویرایش شده </label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="VendorEditListAccept"
                        id="VendorEditListAccept">
                    <label for="VendorEditListAccept" class="text-danger"> تایید تغییرات فروشگاه ویرایش شده </label>
                </div>
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="VendorEditListReport"
                        id="VendorEditListReport">
                    <label for="VendorEditListReport" class="text-danger"> ریپورت تغییرات فروشگاه ویرایش شده </label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="VendorEditListDelete"
                        id="VendorEditListDelete">
                    <label for="VendorEditListDelete" class="text-danger"> حدف تغییرات فروشگاه ویرایش شده </label>
                </div>
    
    
    
                <div class="col-12">
    
                    <br>
    
                    <label for="">محصولات</label>
    
    
                    <hr>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="AllProducts" id="AllProducts">
                    <label for="AllProducts">همه محصولات</label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="editPPage" id="editPPage">
                    <label for="editPPage">صفحه ویرایش محصول</label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="editp" id="editp" id="">
                    <label for="editp">ویرایش محصول</label>
                </div>
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="ladderP" id="ladderP">
                    <label for="ladderP">نردبان محصول</label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="acceptP" id="acceptP" id="">
                    <label for="acceptP">تایید محصول</label>
                </div>
    
    
    
    
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="newSpcP" id="newSpcP">
                    <label for="newSpcP">ارسال محصول به حالت ویژه</label>
                </div>
    
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="AllSpcP" id="AllSpcP">
                    <label for="AllSpcP">
    
    
                        صفحه محصولات ویژه
    
                    </label>
                </div>
    
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="ProductEditList"
                        id="ProductEditList">
                    <label for="ProductEditList" class="text-danger"> صفحه لیست تغییرات محصول ویرایش شده </label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="ProductEditListAccept"
                        id="ProductEditListAccept">
                    <label for="ProductEditListAccept" class="text-danger"> تایید تغییرات محصول ویرایش شده </label>
                </div>
                
                <div class="form-group  m-3">
                    <input type="checkbox" name="ProductEditListDelete"
                        id="ProductEditListDelete">
                    <label for="ProductEditListDelete" class="text-danger"> حذف تغییرات محصول ویرایش شده </label>
                </div>
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="ProductEditListReport"
                        id="ProductEditListReport">
                    <label for="ProductEditListReport" class="text-danger"> ریپورت تغییرات محصول ویرایش شده </label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="deleteSpcP" id="deleteSpcP">
                    <label for="deleteSpcP" class="text-danger">حدف محصول از حالت ویژه</label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="deletep" id="deletep">
                    <label for="deletep" class="text-danger">حذف محصول</label>
                </div>
    
    
    
    
                <div class="col-12">
    
    
    
                    <hr>
                    <div class="form-group  m-3">
                        <input type="checkbox" name="reportVPage"
                            id="reportVPage">
                        <label for="reportVPage"> صفحه ریپوت فروشگاه / محصول </label>
                     
                        <input type="checkbox" name="reportP"      id="reportP">
                        <label for="reportP">ریپوت فروشگاه / محصول</label>
                    </div>
    
                    <hr>
    
                </div>
    
    
                <div class="col-12">
    
                    <br>
    
                    <label for="">دسته بندی ها</label>
    
    
                    <hr>
                </div>
    
                {{--  --}}
    
                <div class="form-group m-3">
                    <input type="checkbox" class="allcats" name="allcats" id="allcats">
                    <label for="allcats"> صفحه دسته بندی ها</label>
    
                </div>
                <div class="form-group  m-3">
                    <input type="checkbox" name="createCatPage" id="createCatPage">
                    <label for="createCatPage"> صفحه افزودن دسته بندی جدید</label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="createCat" id="createCat">
                    <label for="createCat"> افزودن دسته بندی جدید</label>
                </div>
                <div class="form-group  m-3">
                    <input type="checkbox" name="editCat" id="editCat">
                    <label for="editCat"> ویرایش دسته بندی ها (همراه با افزودن مقاله برای هر دسته بندی)</label>
                </div>
    
                <div class="col-12">
    
                    <br>
    
                    <label for="">کاربران</label>
    
    
                    <hr>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="allUsers" id="allUsers">
                    <label for="allUsers" class="text-danger"> دسترسی به قسمت کاربران و ادمین ها</label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="deleteU" id="deleteU">
                    <label for="deleteU" class="text-danger"> صفحه حذف کاربر ، ادمین</label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="deleteUs" id="deleteUs">
                    <label for="deleteUs" class="text-danger"> حذف کاربر ، ادمین</label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="editUserPage" id="editUserPage">
                    <label for="editUserPage" class="text-danger"> صفحه ویرایش کاربر ، ادمین</label>
                </div>
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="editUser" id="editUser">
                    <label for="editUser" class="text-danger"> ویرایش کاربر ، ادمین</label>
                </div>
    
                <div class="col-12">
    
                    <br>
    
                    <label for="">مقالات</label>
    
    
                    <hr>
                </div>
    
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="AllArticles" id="AllArticles">
                    <label for="AllArticles"> صفحه همه مقالات</label>
                </div>
    
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="editArticlePage" id="editArticlePage">
                    <label for="editArticlePage"> صفحه وبرایش مقاله</label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="editArticle" id="editArticle">
                    <label for="editArticle"> وبرایش مقاله</label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="sendArticlePage" id="sendArticlePage">
                    <label for="sendArticlePage"> (قسمت مقالات سایت)صفحه ایجاد مقاله</label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="sendArticle" id="sendArticle">
                    <label for="sendArticle"> (قسمت مقالات سایت)ایجاد مقاله</label>
                </div>
                <div class="form-group  m-3">
                    <input type="checkbox" name="deleteArticle" id="deleteArticle">
                    <label for="deleteArticle"> (قسمت مقالات سایت)حذف مقاله</label>
                </div>
    
    
                <div class="col-12">
    
                    <br>
    
                    <label for="">برند ها</label>
    
    
                    <hr>
    
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="Allbrands" id="Allbrands">
                    <label for="Allbrands"> صفحه برند ها</label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="createBrandPage" id="createBrandPage">
                    <label for="createBrandPage"> صفحه افزودن برند جدید </label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="createBrand" id="createBrand">
                    <label for="createBrand"> افزودن برند جدید</label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="editBrandpage" id="editBrandpage">
                    <label for="editBrandpage"> صفحه وبرایش برند </label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="editBrand" id="editBrand">
                    <label for="editBrand"> وبرایش برند </label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="deleteBrand" id="deleteBrand">
                    <label for="deleteBrand" class="text-danger"> حذف برند </label>
                </div>
    
    
                <div class="col-12">
    
                    <br>
                    <label for="">دیدگاه ها</label>
                    <hr>
                </div>
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="commentController" id="commentController">
                    <label for="commentController">همه دیدگاه ها</label>
                </div>
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="deleteComment" id="deleteComment">
                    <label for="deleteComment">حدف دیدگاه</label>
                </div>
                {{--  --}}
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="answerComment" id="answerComment">
                    <label for="answerComment">پاسخ به دیدگاه ها</label>
                </div>
    
                <div class="col-12">
    
                    <br>
                    <label for="">تیکت ها</label>
                    <hr>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="ticketspage" id="ticketspage">
                    <label for="ticketspage"> صفحه تیکت ها </label>
                </div>
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="showTickets" id="showTickets">
                    <label for="showTickets"> مشاهده تیکت </label>
                </div>
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="answerTickets" id="answerTickets">
                    <label for="answerTickets"> پاسخ دهی به تیکت ها </label>
                </div>
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" name="closeTk" id="closeTk">
                    <label for="closeTk"> بستن تیکت ها </label>
                </div>
    
    
                <div class="col-12">
    
                    <br>
                    <label for="">اسلایدر ها</label>
                    <hr>
                </div>
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="slidersPage" id="slidersPage">
                    <label for="slidersPage">همه اسلایدر ها </label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="editSliderCount" id="editSliderCount">
                    <label for="editSliderCount">وبرایش تعداد اسلایدر ها </label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="SendSlider" id="SendSlider">
                    <label for="SendSlider">ایجاد اسلایدر جدید </label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="SendSliderPAge" id="SendSliderPAge">
                    <label for="SendSliderPAge"> صفحه ایجاد اسلایدر جدید </label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="editSliderPage" id="editSliderPage">
                    <label for="editSliderPage">صفحه ویرایش اسلایدر</label>
                </div>
    
                {{--  --}}
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="editSlider" id="editSlider">
                    <label for="editSlider"> ویرایش اسلایدر</label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="acceptSlider" id="acceptSlider">
                    <label for="acceptSlider">تایید اسلایدر</label>
                </div>
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="deleteSloder" id="deleteSloder">
                    <label for="deleteSloder" class="text-danger">حذف اسلایدر</label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" class="individual" name="reportSlider" id="reportSlider">
                    <label for="reportSlider">ریپوت اسلایدر</label>
                </div>
    
    
    
    
    
                <div class="col-12">
                    <br>
                    <label for="">استوری ها</label>
                    <hr>
    
                </div>
    
    
                {{--  --}}
                <div class="form-group m-3">
                    <input type="checkbox" class="individual" name="StoriesPage" id="StoriesPage">
                    <label for="StoriesPage">صفحه استوری ها</label>
    
                </div>
    
                {{--  --}}
                <div class="form-group m-3">
                    <input type="checkbox" class="individual" name="createStoryPage" id="createStoryPage">
                    <label for="createStoryPage">صفحه ایجاد استوری </label>
                </div>
    
                <div class="form-group m-3">
                    <input type="checkbox" class="individual" name="newS" id="newS">
                    <label for="newS">ارسال استوری</label>
                </div>
                {{--  --}}
                <div class="form-group m-3">
                    <input type="checkbox" class="individual" name="deleteStory" id="deleteStory">
                    <label for="deleteStory" class="text-danger">حدف استوری</label>
                </div>
    
    
                <div class="col-12">
    
    
                    <br>
                    <label for="">تنظیمات سایت </label>
                    <hr>
                </div>
    
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="siteSettingInpanel" id="siteSettingInpanel">
                    <label for="siteSettingInpanel" class="text-danger">صفحه تنظیمات سایت در پنل </label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="siteSettingInHome" id="siteSettingInHome">
                    <label for="siteSettingInHome" class="text-danger"> تنظیمات سایت در خانه </label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="editAddsPAge" id="editAddsPAge">
                    <label for="editAddsPAge" class="text-danger"> ویرایش تبلیغات (بنر ها) </label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="editContactUsPage" id="editContactUsPage">
                    <label for="editContactUsPage" class="text-danger"> ویرایش تماس با ما </label>
                </div>
                <div class="form-group  m-3">
                    <input type="checkbox" name="editQuestionsPage" id="editQuestionsPage">
                    <label for="editQuestionsPage" class="text-danger"> ویرایش سوالات متداول </label>
                </div>
    
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="editLaws" id="editLaws">
                    <label for="editLaws" class="text-danger"> ویرایش شرایط و قوانین </label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="aboutUs" id="aboutUs">
                    <label for="aboutUs" class="text-danger"> ویرایش درباره ما
                    </label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="footerEdit" id="footerEdit">
                    <label for="footerEdit" class="text-danger"> ویرایش فوتر
                    </label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="waysEdit" id="waysEdit">
                    <label for="waysEdit" class="text-danger"> ویرایش راه های ارتباطی
                    </label>
                </div>
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="addnewPhotoToGallery" id="addnewPhotoToGallery">
                    <label for="addnewPhotoToGallery" class="text-danger">
    
                        افزودن عکس جدید به گالری
    
                    </label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="loginUser" id="loginUser">
                    <label for="loginUser" class="text-danger"> ورود به داشبرد فروشگاه </label>
                </div>
    
    
                <div class="form-group  m-3">
                    <input type="checkbox" name="counting" id="counting">
                    <label for="counting" class="text-danger"> مدیزیت مالی </label>
                </div>
    
    
            </div>
    
    
    
        </div>

        <div class="col-12" id="lvl">
            <select name="permissons_id" class="form-control" id="">
                @foreach ($permissons as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>



        <div class="col-12">
            <input type="submit" value="ثبت کاربر" class="btn btn-info">

        </div>







        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

    </form>
@endsection



<script>
    function show1() {
        $('#lvl').css('display', 'block');

    }


    function show2() {
        $('#lvl').css('display', 'none');

    }
</script>

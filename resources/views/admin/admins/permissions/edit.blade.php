@extends('admin.layouts.admin')

@section('title')
    کارمندان
@endsection



<style>
    .form-group {
        border: 1px solid rgb(224, 222, 222);
        padding: 6px;
    }

    .form-group:hover {
        border: 1px solid gray;
        transition: all 0.2s;
    }
</style>

<script>
    var selectAllItems = "#select-all";
    var checkboxItem = ":checkbox";

    $(selectAllItems).click(function() {

        if (this.checked) {
            $(checkboxItem).each(function() {
                this.checked = true;
            });
        } else {
            $(checkboxItem).each(function() {
                this.checked = false;
            });
        }

    });
</script>
@section('content')

    <h1>
        افزودن دسترسی جدید برای ادمین ها
    </h1>

    <form action="{{ route('admin.premissions.update', ['premission' => $permission]) }}" method="post">

        @method('put')

        @csrf


        <input type="hidden" name="pId" value="{{ $permission->id }}">




        <div class="row">

            <div class=" col-3 p-1">
                <label for="">نام دسترسی</label>
                <input type="text" name="name" class="form-control" id="" value="{{ $permission->name }}"
                    required>
            </div>

            <div class="col-8 p-4 ">

                <textarea name="description" id="description" class="form-control" cols="100" rows="5"
                    placeholder="توضیجات دسترسی">{{ $permission->description }}</textarea>

            </div>
        </div>


        <hr>


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
                <input type="checkbox" class="Addddd" @if ($permissions['admin.vendors.index']) checked @endif name="Allvendors"
                    id="Allvendors">
                <label for="Allvendors">همه فروشگاه ها</label>
            </div>
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.ladderVendor']) checked @endif class="Addddd" name="ladderV"
                    id="ladderV">
                <label for="ladderV">نردبان فروشگاه</label>
            </div>


            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" name="editVPage" id="editVPage" @if ($permissions['admin.vendors.edit']) checked @endif>
                <label for="editVPage"> صفحه ویرایش اظلاعات فروشگاه </label>
            </div>



            <div class="form-group  m-3">
                <input type="checkbox" name="editV" @if ($permissions['admin.vendors.update']) checked @endif id="editV">
                <label for="editV">ویرایش اظلاعات فروشگاه</label>
            </div>
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.acceptVendorRequest']) checked @endif name="acceptVendor"
                    id="acceptVendor" id="">
                <label for="acceptVendor">تایید فروشگاه</label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.vendors.show']) checked @endif name="showVendor" id="showVendor"
                    id="">
                <label for="showVendor"> نمایش فروشگاه</label>
            </div>
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.MakeVendorSpecial']) checked @endif class="Addddd" name="newSpcV"
                    id="newSpcV">
                <label for="newSpcV">ارسال فروشگاه به حالت ویژه</label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.AllSpecialVendors']) checked @endif name="AllSpcVendors"
                    id="AllSpcVendors" id="">
                <label for="AllSpcVendors"> صفحه فروشگاه های ویژه</label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" name="dltSpcVendor" @if ($permissions['admin.deleteFromSpecialVendors']) checked @endif
                    id="dltSpcVendor">
                <label for="dltSpcVendor" class="text-danger"> حدف فروشگاه از حالت ویژه</label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" name="deleteV" @if ($permissions['admin.destroyVendor']) checked @endif id="deleteV">
                <label for="deleteV" class="text-danger"> حدف فروشگاه</label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.deleteVendor']) checked @endif name="deleteVPage"
                    id="deleteVPage">
                <label for="deleteVPage" class="text-danger"> صفحه حذف فروشگاه</label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.VendorEditList.show']) checked @endif name="VendorEditList"
                    id="VendorEditList">
                <label for="VendorEditList" class="text-danger"> صفحه لیست تغییرات فروشگاه ویرایش شده </label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.VendorEditList.saveChanges']) checked @endif name="VendorEditListAccept"
                    id="VendorEditListAccept">
                <label for="VendorEditListAccept" class="text-danger"> تایید تغییرات فروشگاه ویرایش شده </label>
            </div>
            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.VendorEditList.report']) checked @endif name="VendorEditListReport"
                    id="VendorEditListReport">
                <label for="VendorEditListReport" class="text-danger"> ریپورت تغییرات فروشگاه ویرایش شده </label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.VendorEditList.deleteChanges']) checked @endif name="VendorEditListDelete"
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
                <input type="checkbox" class="Addddd" @if ($permissions['admin.products.index']) checked @endif
                    name="AllProducts" id="AllProducts">
                <label for="AllProducts">همه محصولات</label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.products.edit']) checked @endif class="Addddd" name="editPPage"
                    id="editPPage">
                <label for="editPPage">صفحه ویرایش محصول</label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.products.update']) checked @endif name="editp" id="editp"
                    id="">
                <label for="editp">ویرایش محصول</label>
            </div>
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.products.ladder']) checked @endif class="Addddd" name="ladderP"
                    id="ladderP">
                <label for="ladderP">نردبان محصول</label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.acceptProduct']) checked @endif name="acceptP" id="acceptP"
                    id="">
                <label for="acceptP">تایید محصول</label>
            </div>






            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.MakeProductSpecial']) checked @endif class="Addddd" name="newSpcP"
                    id="newSpcP">
                <label for="newSpcP">ارسال محصول به حالت ویژه</label>
            </div>



            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.allSpecialProducts']) checked @endif class="Addddd" name="AllSpcP"
                    id="AllSpcP">
                <label for="AllSpcP">


                    صفحه محصولات ویژه

                </label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.productEditList.show']) checked @endif name="ProductEditList"
                    id="ProductEditList">
                <label for="ProductEditList" class="text-danger"> صفحه لیست تغییرات محصول ویرایش شده </label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.productEditList.saveChanges']) checked @endif name="ProductEditListAccept"
                    id="ProductEditListAccept">
                <label for="ProductEditListAccept" class="text-danger"> تایید تغییرات محصول ویرایش شده </label>
            </div>
            
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.productEditList.deleteChanges']) checked @endif name="ProductEditListDelete"
                    id="ProductEditListDelete">
                <label for="ProductEditListDelete" class="text-danger"> حذف تغییرات محصول ویرایش شده </label>
            </div>
            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.productEditList.report']) checked @endif name="ProductEditListReport"
                    id="ProductEditListReport">
                <label for="ProductEditListReport" class="text-danger"> ریپورت تغییرات محصول ویرایش شده </label>
            </div>




            <div class="form-group  m-3">
                <input type="checkbox" class="Addddd" name="deleteSpcP" id="deleteSpcP"
                    @if ($permissions['admin.deleteFromSpecials']) checked @endif>
                <label for="deleteSpcP" class="text-danger">حدف محصول از حالت ویژه</label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" name="deletep" id="deletep" @if ($permissions['admin.deleteProduct']) checked @endif>
                <label for="deletep" class="text-danger">حذف محصول</label>
            </div>




            <div class="col-12">




                ریپوت
                <hr>


                <div class="form-group  m-3">
                    <input type="checkbox" name="reportVPage" @if ($permissions['admin.SendWarningMassageToVendor']) checked @endif
                        id="reportVPage">
                    <label for="reportVPage"> صفحه ریپوت فروشگاه / محصول </label>
                 
                    <input type="checkbox" name="reportP" @if ($permissions['admin.SendWarningMassageToVendor']) checked @endif
                        id="reportP">
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
                <input type="checkbox" class="allcats" @if ($permissions['admin.categories.index']) checked @endif name="allcats"
                    id="allcats">
                <label for="allcats"> صفحه دسته بندی ها</label>

            </div>
            <div class="form-group  m-3">
                <input type="checkbox" name="createCatPage" @if ($permissions['admin.categories.create']) checked @endif
                    id="createCatPage">
                <label for="createCatPage"> صفحه افزودن دسته بندی جدید</label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.categories.store']) checked @endif name="createCat"
                    id="createCat">
                <label for="createCat"> افزودن دسته بندی جدید</label>
            </div>
            <div class="form-group  m-3">
                <input type="checkbox" name="editCat" @if ($permissions['admin.categories.update']) checked @endif id="editCat">
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
                <input type="checkbox" @if ($permissions['admin.articles.index']) checked @endif name="AllArticles"
                    id="AllArticles">
                <label for="AllArticles"> صفحه همه مقالات</label>
            </div>


            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.articles.edit']) checked @endif name="editArticlePage"
                    id="editArticlePage">
                <label for="editArticlePage"> صفحه وبرایش مقاله</label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.articles.update']) checked @endif name="editArticle"
                    id="editArticle">
                <label for="editArticle"> وبرایش مقاله</label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.articles.create']) checked @endif name="sendArticlePage"
                    id="sendArticlePage">
                <label for="sendArticlePage"> (قسمت مقالات سایت)صفحه ایجاد مقاله</label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.articles.store']) checked @endif name="sendArticle"
                    id="sendArticle">
                <label for="sendArticle"> (قسمت مقالات سایت)ایجاد مقاله</label>
            </div>
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.articles.destroy']) checked @endif name="deleteArticle"
                    id="deleteArticle">
                <label for="deleteArticle"> (قسمت مقالات سایت)حذف مقاله</label>
            </div>


            <div class="col-12">

                <br>

                <label for="">برند ها</label>


                <hr>

            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.brands.index']) checked @endif name="Allbrands"
                    id="Allbrands">
                <label for="Allbrands"> صفحه برند ها</label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.brands.create']) checked @endif name="createBrandPage"
                    id="createBrandPage">
                <label for="createBrandPage"> صفحه افزودن برند جدید </label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.brands.store']) checked @endif name="createBrand"
                    id="createBrand">
                <label for="createBrand"> افزودن برند جدید</label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.brands.edit']) checked @endif name="editBrandpage"
                    id="editBrandpage">
                <label for="editBrandpage"> صفحه وبرایش برند </label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.brands.update']) checked @endif name="editBrand"
                    id="editBrand">
                <label for="editBrand"> وبرایش برند </label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.brands.destroy']) checked @endif name="deleteBrand"
                    id="deleteBrand">
                <label for="deleteBrand" class="text-danger"> حذف برند </label>
            </div>


            <div class="col-12">

                <br>
                <label for="">دیدگاه ها</label>
                <hr>
            </div>
            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.comments.index']) checked @endif name="commentController"
                    id="commentController">
                <label for="commentController">همه دیدگاه ها</label>
            </div>
            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.comments.destroy']) checked @endif name="deleteComment"
                    id="deleteComment">
                <label for="deleteComment">حدف دیدگاه</label>
            </div>
            {{--  --}}

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.comments.adminAnswer']) checked @endif name="answerComment"
                    id="answerComment">
                <label for="answerComment">پاسخ به دیدگاه ها</label>
            </div>

            <div class="col-12">

                <br>
                <label for="">تیکت ها</label>
                <hr>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.tickets.index']) checked @endif name="ticketspage"
                    id="ticketspage">
                <label for="ticketspage"> صفحه تیکت ها </label>
            </div>
            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.tickets.show']) checked @endif name="showTickets"
                    id="showTickets">
                <label for="showTickets"> مشاهده تیکت </label>
            </div>
            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.tickets.answer']) checked @endif name="answerTickets"
                    id="answerTickets">
                <label for="answerTickets"> پاسخ دهی به تیکت ها </label>
            </div>
            {{--  --}}
            {{-- <div class="form-group  m-3">
                <input type="checkbox" name="closeTk" id="closeTk">
                <label for="closeTk"> بستن تیکت ها </label>
            </div> --}}


            <div class="col-12">

                <br>
                <label for="">اسلایدر ها</label>
                <hr>
            </div>
            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" class="Addddd" @if ($permissions['admin.sliderSetting.index']) checked @endif
                    name="slidersPage" id="slidersPage">
                <label for="slidersPage">همه اسلایدر ها </label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.sliderSetting.store']) checked @endif class="Addddd"
                    name="SendSlider" id="SendSlider">
                <label for="SendSlider">ایجاد اسلایدر جدید </label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.sliderSetting.create']) checked @endif class="Addddd"
                    name="SendSliderPAge" id="SendSliderPAge">
                <label for="SendSliderPAge"> صفحه ایجاد اسلایدر جدید </label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.sliderSetting.edit']) checked @endif class="Addddd"
                    name="editSliderPage" id="editSliderPage">
                <label for="editSliderPage">صفحه ویرایش اسلایدر</label>
            </div>

            {{--  --}}
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.sliderSetting.update']) checked @endif class="Addddd"
                    name="editSlider" id="editSlider">
                <label for="editSlider"> ویرایش اسلایدر</label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.sliderSetting.accept']) checked @endif class="Addddd"
                    name="acceptSlider" id="acceptSlider">
                <label for="acceptSlider">تایید اسلایدر</label>
            </div>
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.sliderSetting.destroy']) checked @endif class="Addddd"
                    name="deleteSloder" id="deleteSloder">
                <label for="deleteSloder" class="text-danger">حذف اسلایدر</label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.sliderSetting.report']) checked @endif class="Addddd"
                    name="reportSlider" id="reportSlider">
                <label for="reportSlider">ریپوت اسلایدر</label>
            </div>





            <div class="col-12">
                <br>
                <label for="">استوری ها</label>
                <hr>

            </div>


            {{--  --}}
            <div class="form-group m-3">
                <input type="checkbox" @if ($permissions['admin.stories.index']) checked @endif class="Addddd"
                    name="StoriesPage" id="StoriesPage">
                <label for="StoriesPage">صفحه استوری ها</label>

            </div>

            {{--  --}}
            <div class="form-group m-3">
                <input type="checkbox" @if ($permissions['admin.stories.create']) checked @endif class="Addddd"
                    name="createStoryPage" id="createStoryPage">
                <label for="createStoryPage">صفحه ایجاد استوری </label>
            </div>

            <div class="form-group m-3">
                <input type="checkbox" @if ($permissions['admin.stories.store']) checked @endif class="Addddd" name="newS"
                    id="newS">
                <label for="newS">ارسال استوری</label>
            </div>
            {{--  --}}
            <div class="form-group m-3">
                <input type="checkbox" @if ($permissions['admin.stories.destroy']) checked @endif class="Addddd"
                    name="deleteStory" id="deleteStory">
                <label for="deleteStory" class="text-danger">حدف استوری</label>
            </div>


            <div class="col-12">


                <br>
                <label for="">تنظیمات سایت </label>
                <hr>
            </div>



            <div class="form-group  m-3">
                <input type="checkbox" name="siteSettingInpanel" @if ($permissions['admin.setting.settindDetail.contant']) checked @endif
                    id="siteSettingInpanel">
                <label for="siteSettingInpanel" class="text-danger">صفحه تنظیمات سایت در پنل </label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.EditHome']) checked @endif name="siteSettingInHome"
                    id="siteSettingInHome">
                <label for="siteSettingInHome" class="text-danger"> تنظیمات سایت در خانه </label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.SiteAdds.index']) checked @endif name="editAddsPAge"
                    id="editAddsPAge">
                <label for="editAddsPAge" class="text-danger"> ویرایش تبلیغات (بنر ها) </label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.setting.settindDetail.contact']) checked @endif name="editContactUsPage"
                    id="editContactUsPage">
                <label for="editContactUsPage" class="text-danger"> ویرایش تماس با ما </label>
            </div>
            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.setting.settindDetail.questions']) checked @endif name="editQuestionsPage"
                    id="editQuestionsPage">
                <label for="editQuestionsPage" class="text-danger"> ویرایش سوالات متداول </label>
            </div>



            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.setting.settindDetail.laws']) checked @endif name="editLaws" id="editLaws">
                <label for="editLaws" class="text-danger"> ویرایش شرایط و قوانین </label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" name="aboutUs" @if ($permissions['admin.setting.settindDetail.aboute']) checked @endif id="aboutUs">
                <label for="aboutUs" class="text-danger"> ویرایش درباره ما
                </label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.setting.settindDetail.footer']) checked @endif name="footerEdit"
                    id="footerEdit">
                <label for="footerEdit" class="text-danger"> ویرایش فوتر
                </label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" name="waysEdit" @if ($permissions['admin.setting.settindDetail.ways']) checked @endif id="waysEdit">
                <label for="waysEdit" class="text-danger"> ویرایش راه های ارتباطی
                </label>
            </div>

            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.articleImages.store']) checked @endif name="addnewPhotoToGallery"
                    id="addnewPhotoToGallery">
                <label for="addnewPhotoToGallery" class="text-danger">

                    افزودن عکس جدید به گالری

                </label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.articleImages.store']) checked @endif name="loginUser"
                    id="loginUser">
                <label for="loginUser" class="text-danger"> ورود به داشبرد فروشگاه </label>
            </div>


            <div class="form-group  m-3">
                <input type="checkbox" @if ($permissions['admin.counting.index']) checked @endif name="counting" id="counting">
                <label for="counting" class="text-danger"> مدیزیت مالی </label>
            </div>


            <div class="col-12">

                <a href="{{ route('admin.premissions.index') }}" class="btn btn-danger">
                    انصراف
                </a>
                <input type="submit" value="ثبت دسترسی" class="btn btn-info">
            </div>

        </div>











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

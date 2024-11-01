<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin\AdminLog;
use App\Models\Admin\Permissions;
use App\Models\User;
use App\Models\UserRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;


use Carbon\Carbon;

class AdminEmployeeControllwe extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $user = Auth::user();

        if ($user->rols[0]->name != "admin") {
            return abort('403');
        }

        $admins = UserRol::where('rol_id', '2')->get();

        return view('admin.admins.index', compact('admins'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        $routes = Route::getRoutes();

        // dd($routes);

        $permissons = Permissions::all();


        return view('admin.admins.create', compact('permissons'));


    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'number' => 'required|digits:11',
            'accc' => 'required',
            'pass' => 'required',
            'repass' => 'required',
        ]);


        $sameNumber = User::where('mobile', $request->number)->first();



        if (!is_null($sameNumber)) {

            session()->flash('NumberErr', 'شماره مورد نظر قبلا در سیستم ثبت شده');

            return redirect()->back();

        } else {

            if ($request->accc == "lvl") {

                $request->validate([
                    'permissons_id' => 'required',
                ]);
                $pId = $request->permissons_id;
                $permission = Permissions::findOrFail($pId);
                $decoded = $permission->permissons;

                
                $pname = $permission->name;

            } else {
                $data = [

                    'admin.dashboard'=>$request->dashboard ? 1 : Null ,
        
                    'admin.VendorEditList.show'=>$request->VendorEditList ? 1 : Null ,
                    'admin.VendorEditList.saveChanges'=>$request->VendorEditListAccept ? 1 : Null ,
                    'admin.VendorEditList.deleteChanges'=>$request->VendorEditListDelete ? 1 : Null ,
                    'admin.VendorEditList.report'=>$request->VendorEditListReport ? 1 : Null ,
                  
                  
                    'admin.productEditList.show'=>$request->VendorEditList ? 1 : Null ,
                    'admin.productEditList.saveChanges'=>$request->VendorEditListAccept ? 1 : Null ,
                    'admin.productEditList.deleteChanges'=>$request->VendorEditListDelete ? 1 : Null ,
                    'admin.productEditList.report'=>$request->VendorEditListReport ? 1 : Null ,
        
                    'admin.stories.create' => $request->createStoryPage ? 1 : Null,
                    'admin.stories.index' => $request->StoriesPage ? 1 : Null,
                    'admin.stories.store' => $request->newS ? 1 : Null,
                    'admin.stories.destroy' => $request->deleteStory ? 1 : Null,
                    'admin.MakeProductSpecial' => $request->newSpcP ? 1 : NULL,
                    'admin.allSpecialProducts' => $request->AllSpcP ? 1 : NULL,
                    'admin.MakeVendorSpecial' => $request->newSpcV ? 1 : NULL,
                    'admin.deleteFromSpecialVendors' => $request->dltSpcVendor ? 1 : NULL,
                    'admin.deleteFromSpecials' => $request->deleteSpcP ? 1 : NULL,
                    'admin.vendors.show' => $request->showVendor ? 1 : NULL,
                    'admin.vendors.edit' => $request->editVPage ? 1 : NULL,
                    'admin.vendors.update' => $request->editV ? 1 : NULL,
                    'admin.vendors.index' => $request->Allvendors ? 1 : NULL,
                    'admin.categories.index' => $request->allcats ? 1 : NULL,
                    'admin.categories.create' => $request->createCatPage ? 1 : NULL,
                    'admin.categories.edit' => $request->editCat ? 1 : NULL,
                    'admin.categories.update' => $request->editCat ? 1 : NULL,
                    'admin.categories.store' => $request->createCat ? 1 : NULL,
                    'admin.deleteVendor' => $request->deleteVPage ? 1 : NULL,
                    'admin.destroyVendor' => $request->deleteV ? 1 : NULL,
                    'admin.AllSpecialVendors' => $request->AllSpcVendors ? 1 : NULL,
                    'admin.sliderSetting.index' => $request->slidersPage ? 1 : Null,
                    'admin.sliderSetting.edit' => $request->editSliderPage ? 1 : Null,
                    'admin.sliderSetting.update' => $request->editSlider ? 1 : Null,
                    'admin.sliderSetting.store' => $request->SendSlider ? 1 : Null,
                    'admin.sliderSetting.create' => $request->SendSliderPAge ? 1 : Null,
                    'admin.sliderSetting.accept' => $request->acceptSlider ? 1 : Null,
                    'admin.sliderSetting.destroy' => $request->deleteSloder ? 1 : Null,
                    'admin.sliderSetting.report' => $request->reportSlider ? 1 : Null,
                    'admin.products.ladder' => $request->ladderP ? 1 : Null,
                    'admin.ladderVendor' => $request->ladderV ? 1 : Null,
                    'admin.acceptProduct' => $request->acceptP ? 1 : Null,
                    'admin.products.index' => $request->AllProducts ? 1 : Null,
                    'admin.products.edit' => $request->editPPage ? 1 : Null,
                    'admin.products.update' => $request->editp ? 1 : Null,
                    'admin.products.destroy' => $request->deletep ? 1 : Null,
                    'admin.SendWarningMassageToVendor' => $request->reportP ? 1 : Null,
                    'admin.sendMessage.edit' => $request->reportP ? 1 : Null,
                    'admin.deleteProduct' => $request->deletep ? 1 : NULL,
                    'admin.comments.index' => $request->commentController ? 1 : NULL,
                    'admin.comments.destroy' => $request->deleteComment ? 1 : NULL,
        
                    'admin.comments.adminAnswer'=>$request->answerComment ? 1 : Null ,
                    'admin.articles.index' => $request->AllArticles ? 1 : Null,
                    'admin.articles.create' => $request->sendArticlePage ? 1 : Null,
                    'admin.articles.edit' => $request->editArticlePage ? 1 : Null,
                    'admin.articles.update' => $request->editArticle ? 1 : Null,
                    'admin.articles.destroy' => $request->deleteArticle ? 1 : Null,
                    'admin.articles.store' => $request->sendArticle ? 1 : Null,
                    'admin.brands.index' => $request->Allbrands ? 1 : Null,
                    'admin.brands.create' => $request->createBrandPage ? 1 : Null,
                    'admin.brands.update' => $request->editBrand ? 1 : Null,
                    'admin.brands.edit' => $request->editBrandpage ? 1 : Null,
                    'admin.brands.destroy' => $request->deleteBrand ? 1 : NULL,
                    'admin.brands.store' => $request->createBrand ? 1 : NULL,
                    'admin.tickets.index' => $request->ticketspage ? 1 : NULL,
                    'admin.tickets.show' => $request->showTickets ? 1 : NULL,
                    'admin.tickets.answer' => $request->answerTickets ? 1 : NULL,
                    'admin.setting.index'=>$request->siteSettingInpanel ? 1 : Null ,
                    'admin.EditHome'=>$request->siteSettingInHome ? 1 : Null ,
                    'admin.SiteAdds.index'=>$request->editAddsPAge ? 1 : Null ,
                    'admin.SiteAdds.create'=>$request->editAddsPAge ? 1 : Null ,
                    'admin.SiteAdds.edit'=>$request->editAddsPAge ? 1 : Null ,
                    'admin.SiteAdds.destroy'=>$request->editAddsPAge ? 1 : Null ,
                    'admin.SiteAdds.store'=>$request->editAddsPAge ? 1 : Null ,
                    'admin.setting.settindDetail.contant'=>$request->siteSettingInpanel ? 1 : Null ,
                    'admin.questions.update'=>$request->siteSettingInpanel ? 1 : Null ,
                    'admin.setting.settindDetail.questions'=>$request->editQuestionsPage ? 1 : Null ,
                    'admin.setting.settindDetail.laws'=>$request->editLaws ? 1 : Null ,
                    'admin.setting.settindDetail.aboute'=>$request->aboutUs ? 1 : Null ,
                    'admin.setting.settindDetail.contact'=>$request->editContactUsPage ? 1 : Null ,
                    'admin.setting.settindDetail.footer'=>$request->footerEdit ? 1 : Null ,
                    'admin.setting.settindDetail.ways'=>$request->waysEdit ? 1 : Null ,
                    'admin.articleImages.store'=>$request->addnewPhotoToGallery ? 1 : Null ,
                    'admin.loginAsVendor' => $request->loginUser ? 1 : null,
                    'admin.counting.index' => $request->counting ? 1 : null,
                    'admin.acceptVendorRequest' => $request->acceptVendor ? 1 : null,
                ];
        
        
                $decoded = json_encode($data);

                $pname = 'custom';
            }




            $password = Hash::make($request->pass);


            $user = User::create([
                'mobile' => $request->number,
                'name' => $request->name,
                'boss_id' => Auth::user()->id,
                'password' => Hash::make($request->pass),
                'permissions' => $decoded,
                'mobile_verified_at' => Carbon::now(),
                'permission_name_for_admins' => $pname,
            ]);

            $role = Rol::where('name', 'admin')->first();
            $user->rols()->save($role);

            if (is_null($user)) {


                session()->flash('msg', 'عملیات با شکست مواحه شد');

            } else {

                session()->flash('msg', 'کاربر جدید با موفقیت ایحاد شد');

            }

            return redirect()->route('admin.admins.index');
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $admin = User::findOrFail($id);
        $jsonedPermissions = json_decode($admin->permissions);
        $permissions = get_object_vars($jsonedPermissions);
        $allPermissions = Permissions::all();
        // dd($permissons);
        if (is_null($admin->boss_id)) {
            return abort(404);
        } else {
            return view('admin.admins.edit', compact('admin', 'permissions', 'allPermissions'));
        }


    }
    /**
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'admin_id' => 'required',
            'number' => 'required|digits:11'
            // 'pass'=>'required|same:repass'
        ]);


        $user = User::findOrFail($request->admin_id);



        if ($request->accc == "lvl") {

            $request->validate([
                'permissons_id' => 'required',
            ]);
            $pId = $request->permissons_id;
            $permission = Permissions::findOrFail($pId);
            $decoded = $permission->permissons;

            $pname = $permission->name;

        } else {

            $data = [

                'admin.dashboard'=>$request->dashboard ? 1 : Null ,
    
                'admin.VendorEditList.show'=>$request->VendorEditList ? 1 : Null ,
                'admin.VendorEditList.saveChanges'=>$request->VendorEditListAccept ? 1 : Null ,
                'admin.VendorEditList.deleteChanges'=>$request->VendorEditListDelete ? 1 : Null ,
                'admin.VendorEditList.report'=>$request->VendorEditListReport ? 1 : Null ,
              
              
                'admin.productEditList.show'=>$request->VendorEditList ? 1 : Null ,
                'admin.productEditList.saveChanges'=>$request->VendorEditListAccept ? 1 : Null ,
                'admin.productEditList.deleteChanges'=>$request->VendorEditListDelete ? 1 : Null ,
                'admin.productEditList.report'=>$request->VendorEditListReport ? 1 : Null ,
    
                'admin.stories.create' => $request->createStoryPage ? 1 : Null,
                'admin.stories.index' => $request->StoriesPage ? 1 : Null,
                'admin.stories.store' => $request->newS ? 1 : Null,
                'admin.stories.destroy' => $request->deleteStory ? 1 : Null,
                'admin.MakeProductSpecial' => $request->newSpcP ? 1 : NULL,
                'admin.allSpecialProducts' => $request->AllSpcP ? 1 : NULL,
                'admin.MakeVendorSpecial' => $request->newSpcV ? 1 : NULL,
                'admin.deleteFromSpecialVendors' => $request->dltSpcVendor ? 1 : NULL,
                'admin.deleteFromSpecials' => $request->deleteSpcP ? 1 : NULL,
                'admin.vendors.show' => $request->showVendor ? 1 : NULL,
                'admin.vendors.edit' => $request->editVPage ? 1 : NULL,
                'admin.vendors.update' => $request->editV ? 1 : NULL,
                'admin.vendors.index' => $request->Allvendors ? 1 : NULL,
                'admin.categories.index' => $request->allcats ? 1 : NULL,
                'admin.categories.create' => $request->createCatPage ? 1 : NULL,
                'admin.categories.edit' => $request->editCat ? 1 : NULL,
                'admin.categories.update' => $request->editCat ? 1 : NULL,
                'admin.categories.store' => $request->createCat ? 1 : NULL,
                'admin.deleteVendor' => $request->deleteVPage ? 1 : NULL,
                'admin.destroyVendor' => $request->deleteV ? 1 : NULL,
                'admin.AllSpecialVendors' => $request->AllSpcVendors ? 1 : NULL,
                'admin.sliderSetting.index' => $request->slidersPage ? 1 : Null,
                'admin.sliderSetting.edit' => $request->editSliderPage ? 1 : Null,
                'admin.sliderSetting.update' => $request->editSlider ? 1 : Null,
                'admin.sliderSetting.store' => $request->SendSlider ? 1 : Null,
                'admin.sliderSetting.create' => $request->SendSliderPAge ? 1 : Null,
                'admin.sliderSetting.accept' => $request->acceptSlider ? 1 : Null,
                'admin.sliderSetting.destroy' => $request->deleteSloder ? 1 : Null,
                'admin.sliderSetting.report' => $request->reportSlider ? 1 : Null,
                'admin.products.ladder' => $request->ladderP ? 1 : Null,
                'admin.ladderVendor' => $request->ladderV ? 1 : Null,
                'admin.acceptProduct' => $request->acceptP ? 1 : Null,
                'admin.products.index' => $request->AllProducts ? 1 : Null,
                'admin.products.edit' => $request->editPPage ? 1 : Null,
                'admin.products.update' => $request->editp ? 1 : Null,
                'admin.products.destroy' => $request->deletep ? 1 : Null,
                'admin.SendWarningMassageToVendor' => $request->reportP ? 1 : Null,
                'admin.sendMessage.edit' => $request->reportP ? 1 : Null,
                'admin.deleteProduct' => $request->deletep ? 1 : NULL,
                'admin.comments.index' => $request->commentController ? 1 : NULL,
                'admin.comments.destroy' => $request->deleteComment ? 1 : NULL,
    
                'admin.comments.adminAnswer'=>$request->answerComment ? 1 : Null ,
                'admin.articles.index' => $request->AllArticles ? 1 : Null,
                'admin.articles.create' => $request->sendArticlePage ? 1 : Null,
                'admin.articles.edit' => $request->editArticlePage ? 1 : Null,
                'admin.articles.update' => $request->editArticle ? 1 : Null,
                'admin.articles.destroy' => $request->deleteArticle ? 1 : Null,
                'admin.articles.store' => $request->sendArticle ? 1 : Null,
                'admin.brands.index' => $request->Allbrands ? 1 : Null,
                'admin.brands.create' => $request->createBrandPage ? 1 : Null,
                'admin.brands.update' => $request->editBrand ? 1 : Null,
                'admin.brands.edit' => $request->editBrandpage ? 1 : Null,
                'admin.brands.destroy' => $request->deleteBrand ? 1 : NULL,
                'admin.brands.store' => $request->createBrand ? 1 : NULL,
                'admin.tickets.index' => $request->ticketspage ? 1 : NULL,
                'admin.tickets.show' => $request->showTickets ? 1 : NULL,
                'admin.tickets.answer' => $request->answerTickets ? 1 : NULL,
                'admin.setting.index'=>$request->siteSettingInpanel ? 1 : Null ,
                'admin.EditHome'=>$request->siteSettingInHome ? 1 : Null ,
                'admin.SiteAdds.index'=>$request->editAddsPAge ? 1 : Null ,
                'admin.SiteAdds.create'=>$request->editAddsPAge ? 1 : Null ,
                'admin.SiteAdds.edit'=>$request->editAddsPAge ? 1 : Null ,
                'admin.SiteAdds.destroy'=>$request->editAddsPAge ? 1 : Null ,
                'admin.SiteAdds.store'=>$request->editAddsPAge ? 1 : Null ,
                'admin.setting.settindDetail.contant'=>$request->siteSettingInpanel ? 1 : Null ,
                'admin.questions.update'=>$request->siteSettingInpanel ? 1 : Null ,
                'admin.setting.settindDetail.questions'=>$request->editQuestionsPage ? 1 : Null ,
                'admin.setting.settindDetail.laws'=>$request->editLaws ? 1 : Null ,
                'admin.setting.settindDetail.aboute'=>$request->aboutUs ? 1 : Null ,
                'admin.setting.settindDetail.contact'=>$request->editContactUsPage ? 1 : Null ,
                'admin.setting.settindDetail.footer'=>$request->footerEdit ? 1 : Null ,
                'admin.setting.settindDetail.ways'=>$request->waysEdit ? 1 : Null ,
                'admin.articleImages.store'=>$request->addnewPhotoToGallery ? 1 : Null ,
                'admin.loginAsVendor' => $request->loginUser ? 1 : null,
                'admin.counting.index' => $request->counting ? 1 : null,
                'admin.acceptVendorRequest' => $request->acceptVendor ? 1 : null,
            ];
    
            $decoded = json_encode($data);

            $pname = 'custom';
        }




        try {

            $user->update([
                'name' => $request->name,
                'mobile' => $request->number,
                'permissions' => $decoded,
                'permission_name_for_admins' => $pname,
                'status'=>$request->status

            ]);
            session()->flash('msg', 'ادمین موزد نظر  با موفقیت ویرایش شد');



        } catch (\Exception $e) {
            session()->flash('msg', 'عملیات با شکست مواحه شد');

        }



        return redirect()->route('admin.admins.index');




    }
    public function destroy($id)
    {
        //
    }





    public function EmployeesLogs($id)
    {
        $user = User::findOrFail($id);


        $logs = $user->logs;


        return view('user.Employers.userLogs', compact('user', 'logs'));

    }






    public function adminslogs($id)
    {



        $user = User::findOrFail($id);

        $logs = AdminLog::where( 'admin_id' , $id)->OrderByDesc('id')->get();


        return view('admin.admins.logs' , compact('user' ,'logs'));



    }





    public function deleteEveryDays(){
        
        $log =  AdminLog::first();
        $log->delete();
    
    }




    public function adminslogsShow($id){
        $log = AdminLog::findOrFail($id);

        $admin = User::findOrFail($log->admin_id);

        
        return view('admin.admins.logShow' , compact('log' , 'admin'));




    }



    public function deleteAadmin(Request $request){
        $admin = User::findOrFail($request->uid);


        $logs = $admin->logs;


        foreach($logs as $log){
            $log->delete();
        
        }
        $admin->delete();

        session()->flash('msg', 'ادمین موزد نظر  با موفقیت حذف شد');

        return redirect()->route('admin.admins.index');

    }

}
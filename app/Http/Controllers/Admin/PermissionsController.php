<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionsRequest;
use App\Http\Requests\UpdatePermissionsRequest;
use App\Models\Admin\Permissions;

use App\Models\User;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $permissons = Permissions::all();

        return view('admin.admins.permissions.index', compact('permissons'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.permissions.create');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        

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

        $is_exist = Permissions::where('name', $request->name)->first();


        if (!is_null($is_exist)) {
            session()->flash('msg', 'این دسترسی قبلا ثبت شده است');
            return redirect()->route('admin.premissions.index');
        }

        $jsoned = json_encode($data);

        $permission = Permissions::create([

            'name' => $request->name,
            'permissons' => $jsoned,
            'description' => $request->description,

        ]);


        session()->flash('msg', 'دسترسی جدید برای ادمین ها با موفقیت ایجاد شد');
        return redirect()->route('admin.premissions.index');





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show(Permissions $permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit($permissions)
    {
        $permission = Permissions::findOrFail($permissions);


        $jsonedPermissions = json_decode($permission->permissons);



        $permissions = get_object_vars($jsonedPermissions);


        return view('admin.admins.permissions.edit', compact('permission', 'permissions'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  \App\Models\Admin\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $permission = Permissions::findOrFail($request->pId);
       
        $admins = User::where('permission_name_for_admins', $permission->name)->get();



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

        $jsoned = json_encode($data);

        $permission->update([
            'name' => $request->name,
            'permissons' => $jsoned,
            'description' => $request->description,
        ]);


        foreach ($admins as $admin) {
            $admin->update([
                'permissions'=>$jsoned ,
                'permission_name_for_admins'=>$permission->name
            ]);
        }

        
        session()->flash('msg', 'دسترسی مورد نظر با موفقیت وبرایش شد');
        return redirect()->route('admin.premissions.index');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permissions $permissions)
    {
        //
    }



    public function premissionsUsers($id)
    {

        $permission = Permissions::findOrFail($id);




        $adminss = User::where('permission_name_for_admins', $permission->name)->get();

        // dd($admins);
        return view('admin.admins.index', compact('adminss' , 'permission'));




    }
}
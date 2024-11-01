<?php

use App\Http\Controllers\Admin\AdminEmployeeControllwe;
use App\Http\Controllers\Admin\AdminVendorController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ArtcilePicturesController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\BuyGuidProductController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\CategoryArticleController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeArticles;
use App\Http\Controllers\HomeVendorController;
use App\Http\Controllers\Home\HomeCategoryController;
use App\Http\Controllers\MessageFromAdminController;
use App\Http\Controllers\NewsLinksController;
use App\Http\Controllers\OfferCodeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\ProductCommentsController;
use App\Http\Controllers\RateProductController;
use App\Http\Controllers\RateVendorController;
use App\Http\Controllers\Search\SearchController as SearchSearchController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SiteSidBarAddsController;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\SpecialProductsController;
use App\Http\Controllers\SpecialVendorsController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserArticlesController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProductImageController;
use App\Http\Controllers\User\UserEmployeeController;
use App\Http\Controllers\User\userNotificationController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\userVendorController;
use App\Http\Controllers\User\VendorImageController;
use App\Http\Controllers\User\verifyUser;
use App\Http\Controllers\vendors\CategoryController as VendorsCategoryController;
use App\Http\Controllers\vendors\ProductController as VendorsProductController;
use App\Http\Middleware\CheckAdminPermission;
use App\Http\Middleware\CheckUserPermission;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\isUser;
use App\Http\Middleware\MustVerified;
use App\Http\Middleware\RedirectVendorEnabled;
use App\Http\Middleware\UserAccessVendor;
use App\Http\Middleware\VendorEnabled;
use App\Http\Middleware\VisitCount;
use App\Notifications\UserVerified;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Route::get('/test', [Controller::class, 'test'])->name('test');

Route::get('/', [Controller::class, 'home'])->name('home')->middleware([VisitCount::class]);


Route::get('/artisan' , function(){
    Artisan::call("config:cache");
    dd('asdsasdasdasd');
})->name('pageNoFound');





Route::get('/pageNoFound' , function(){

    return view('errors.404');
})->name('pageNoFound');



Route::prefix('/')
    ->name('home.')
    ->middleware([VisitCount::class])
    ->group(function () {
        Route::get('/questions', [Controller::class, 'questions'])->name('questions');
        Route::get('/laws', [Controller::class, 'laws'])->name('laws');
        Route::get('/aboute_us', [Controller::class, 'aboute_us'])->name('aboute_us');
        Route::get('/contact_us', [Controller::class, 'contact_us'])->name('contact_us');

        Route::prefix('/guid')
            ->name('guid.')
            ->group(function () {
                Route::get('/Add', [Controller::class, 'Add'])->name('Add');
                Route::get('/buy', [Controller::class, 'buyGuid'])->name('buy');
                Route::get('/vendorPage', [Controller::class, 'vendorGuid'])->name('vendor');
                Route::get('/productPage', [Controller::class, 'productGuid'])->name('product');
            });

        Route::get('/stories' , [Controller::class , 'stories'])->name('stories');
      
        Route::post('seenStory' , [Controller::class , 'seenStory'])->name('seenStory');
      
        Route::get('/articles', [HomeArticles::class, 'index'])->name('HomeArticles');

        Route::get('/article/show/{article:slug}', [HomeArticles::class, 'show'])->name('HomeArticle.show');

        Route::get('/links', [NewsLinksController::class, 'homeIndex'])->name('NewsLinks.index');

        Route::get('/BuyProductGuid', [BuyGuidProductController::class, 'homeIndex'])->name('BuyProductGuid.homeIndex');

        Route::get('/BuyProductGuid/{id}', [BuyGuidProductController::class, 'show'])->name('BuyProductGuid.show');

        Route::get('/userArticles', [UserArticlesController::class, 'homeIndex'])->name('userArticles.homeIndex');

        Route::get('/userArticles/{id}', [UserArticlesController::class, 'show'])->name('userArticles.show');
    });

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('loginPost');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('registerPost');

Route::get('reset-password', [ResetPasswordController::class, 'index'])->name('reset_pass');
Route::post('reset-password', [ResetPasswordController::class, 'resetpass'])->name('reset_passPost');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/Sendticket', [TicketController::class, 'save'])->name('sendTicket');
Route::post('/Sendticket2', [TicketController::class, 'save2'])->name('Sendticket2');
Route::post('/AjaxcheckSlider', [SlidersController::class, 'AjaxcheckSlider']);

Route::prefix('admin-dashboard')
    ->name('admin.')
    ->middleware([isLogin::class, isAdmin::class,CheckAdminPermission::class    
    ])
    ->group(function () {
        Route::get('/', [AdminVendorController::class, 'dashboard'])->name('dashboard');


        Route::get('/products_in_Queue' ,[\App\Http\Controllers\Admin\ProductController::class , 'products_in_Queue'])->name('products_in_Queue');


        Route::post('/download', [Controller::class, 'downloadFile'])->name('downloadFile');

        Route::get('/showUserDetail/{id}', [AdminVendorController::class, 'showVendorUserDetail'])->name('showUserDetail');

        Route::post('/loginAsVendor', [AdminVendorController::class, 'loginAsVendor'])->name('loginAsVendor');

        Route::post('/changeBrand', [BrandController::class, 'changeBrand'])->name('changeBrand');

        Route::post('/pin', [AdminVendorController::class, 'pin'])->name('pin');

        Route::prefix('/sliderSetting')
            ->name('sliderss.')
            ->group(function () {

                Route::get('/', [\App\Http\Controllers\Admin\SlidersController::class, 'index'])->name('index');
                Route::get('/report/{id}', [\App\Http\Controllers\Admin\SlidersController::class, 'report'])->name('report');
                Route::get('/create', [\App\Http\Controllers\Admin\SlidersController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [\App\Http\Controllers\Admin\SlidersController::class, 'edit'])->name('edit');
                Route::post('/destroy', [\App\Http\Controllers\Admin\SlidersController::class, 'destroy'])->name('destroy');
                Route::post('/update', [\App\Http\Controllers\Admin\SlidersController::class, 'update'])->name('update');
                Route::post('/accept', [\App\Http\Controllers\Admin\SlidersController::class, 'accept'])->name('accept');
                Route::post('/store', [\App\Http\Controllers\Admin\SlidersController::class, 'store'])->name('store');

            });

        Route::prefix('/stories')
            ->name('stories.')
            ->group(function () {
                Route::get('/', [StoryController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\Admin\StoryController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [\App\Http\Controllers\Admin\StoryController::class, 'edit'])->name('edit');
                Route::post('/update', [\App\Http\Controllers\Admin\StoryController::class, 'update'])->name('update');
                Route::post('/destroy', [\App\Http\Controllers\Admin\StoryController::class, 'destroy'])->name('destroy');
                Route::post('/accept', [\App\Http\Controllers\Admin\StoryController::class, 'accept'])->name('accept');
                Route::post('/store', [\App\Http\Controllers\Admin\StoryController::class, 'store'])->name('store');

            });
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

        Route::get('/ticket/{id}', [TicketController::class, 'show'])->name('tickets.show');

        Route::post('/answerTicket', [TicketController::class, 'answer'])->name('tickets.answer');

        Route::get('users', [AdminVendorController::class, 'allUsers'])->name('allUsers');

        Route::resource('admins', AdminEmployeeControllwe::class);
        Route::resource('brands', BrandController::class);
        Route::resource('attributes', AttributeController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('vendors', AdminVendorController::class);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('premissions', \App\Http\Controllers\Admin\PermissionsController::class);
        Route::resource('/articles', CategoryArticleController::class);
        Route::resource('/counting', paymentController::class);
        Route::resource('/odderCodes', OfferCodeController::class);
        Route::resource('UserArticles', \App\Http\Controllers\Admin\UserArticlesController::class);
        Route::resource('/newsLinks', NewsLinksController::class);
        Route::resource('/orders', \App\Http\Controllers\Admin\OrdersController::class);
        Route::get('/vendorsInQueue', [AdminVendorController::class, 'vendorsInQueue'])->name('vendorsInQueue');

        Route::post('/deleteByGroupProduct' , [AdminProductController::class , 'deleteByGroup'])->name('products.deleteByGroup');

        Route::post('/categoriesDestroy', [CategoryController::class, 'destroy'])->name('categoriesDestroy');
        Route::get('/MoveBrandToExist', [BrandController::class, 'MoveBrandToExist'])->name('MoveBrandToExist');

        Route::post('/acceptUserArticle', [\App\Http\Controllers\Admin\UserArticlesController::class, 'acceptUserArticle'])->name('acceptUserArticle');

        Route::get('/premissionsUsers/{id}', [PermissionsController::class, 'premissionsUsers'])->name('premissionsUsers');

        Route::get('/adminslogs/{id}', [AdminEmployeeControllwe::class, 'adminslogs'])->name('adminslogs');

        Route::get('/adminslogs/show/{id}', [AdminEmployeeControllwe::class, 'adminslogsShow'])->name('adminslogsShow');

        Route::post('/dadmin', [AdminEmployeeControllwe::class, 'deleteAadmin'])->name('deleteAadmin');

        Route::prefix('VendorEditList')->name('VendorEditList.')->group(function () {

            Route::get('/{id}', [AdminVendorController::class, "productEditList"])->name('show');

            Route::post('/saveChanges', [AdminVendorController::class, "saveChanges"])->name('saveChanges');

            Route::post('/deleteChanges', [AdminVendorController::class, "deleteChanges"])->name('deleteChanges');

            Route::post('/report', [AdminVendorController::class, "reportChanges"])->name('report');

        });

        Route::prefix('productEditList')
            ->group(function () {
                Route::get('/{id}', [\App\Http\Controllers\Admin\ProductController::class, "productEditList"])->name('productEditList');

                Route::post('/saveChanges', [\App\Http\Controllers\Admin\ProductController::class, "saveChanges"])->name('productEditList.saveChanges');

                Route::post('/deleteChanges', [\App\Http\Controllers\Admin\ProductController::class, "deleteChanges"])->name('productEditList.deleteChanges');

                Route::post('/report', [\App\Http\Controllers\Admin\ProductController::class, "reportChanges"])->name('productEditList.report');

            });

        Route::post('/acceptVendorRequest', [AdminVendorController::class, 'acceptVendor'])->name('acceptVendorRequest');
        Route::get('/category-attributes/{category}', [CategoryController::class, 'getCategoryAttributes']);
        // Route::get('/SiteSetting', [SiteSettingController::class, 'index'])->name('setting.index');

        Route::post('/deleteBrand', [BrandController::class, 'deleteBrand'])->name('deleteBRand');

        Route::get('/deleteUser/{user}', [AdminVendorController::class, 'deleteUserPage'])->name('deleteUser');
        Route::get('/deleteVendor/{vendor}', [AdminVendorController::class, 'deleteVendorPage'])->name('deleteVendor');

        Route::post('/destroyUser', [AdminVendorController::class, 'destroyUser'])->name('destroyUser');
        Route::post('/deleteVendor', [AdminVendorController::class, 'destroyVendor'])->name('destroyVendor');
        Route::resource('/buyGuidProduct', BuyGuidProductController::class);

        Route::prefix('/setting')
            ->name('settindDetail.')

            ->group(function () {




                Route::get('/subtitle' , [SiteSettingController::class , 'subtitle'])->name('subtitle');

                Route::get('/dargah', [SiteSettingController::class, 'dargahSettingPage'])->name('dargahSettingPage');
                Route::get('/picturesBookMarkets', [SiteSettingController::class, 'picturesBookMarkets'])->name('picturesBookMarkets');
                Route::post('/DestroyPicFromBookmarkets', [SiteSettingController::class, 'DestroyPicFromBookmarkets'])->name('DestroyPicFromBookmarkets');
                Route::POST('/dargahUpdate', [SiteSettingController::class, 'dargahUpdate'])->name('dargahUpdate');

                Route::get('/EditHomeCounts', [SiteSettingController::class, 'EditHomeCounts'])->name('EditHomeCounts');
                Route::post('/UpdateHomeCounts', [SiteSettingController::class, 'UpdateHomeCounts'])->name('UpdateHomeCounts');

                Route::get('/', [SiteSettingController::class, 'index'])->name('index');

                Route::get('/gifs', [SiteSettingController::class, 'editGifsPage'])->name('gifs');

                Route::post('/UpdateSetting', [SiteSettingController::class, 'update'])->name('setting.update');

                Route::get('/aboute', [SiteSettingController::class, 'aboute'])->name('aboute');
                Route::put('/aboute/update', [SiteSettingController::class, 'update2'])->name('aboute.update');

                Route::get('/ways', [SiteSettingController::class, 'ways'])->name('ways');
                Route::put('/ways/update', [SiteSettingController::class, 'update2'])->name('ways.update');

                Route::get('/laws', [SiteSettingController::class, 'laws'])->name('laws');
                Route::put('/laws/update', [SiteSettingController::class, 'update2'])->name('laws.update');

                Route::get('/questions', [SiteSettingController::class, 'questions'])->name('questions');
                Route::put('/questions/update', [SiteSettingController::class, 'update2'])->name('questions.update');

                Route::get('/contact', [SiteSettingController::class, 'contact'])->name('contact');
                Route::put('/contact/update', [SiteSettingController::class, 'update2'])->name('contact.update');

                Route::get('/footer', [SiteSettingController::class, 'footer'])->name('footer');
                Route::put('/footer/update', [SiteSettingController::class, 'update2'])->name('footer.update');

                Route::post('/newLink', [SiteSettingController::class, 'storefooterLink'])->name('link.store');
                Route::post('/deleteLink', [SiteSettingController::class, 'deletefooterLink'])->name('link.delete');

                Route::get('/buyGiud', [SiteSettingController::class, 'bugGiud'])->name('bugGiud');

                Route::get('/vendorPageGuid', [SiteSettingController::class, 'vendorPageGuid'])->name('vendorPageGuid');

                Route::get('/productPageGuid', [SiteSettingController::class, 'productPageGuid'])->name('productPageGuid');

                Route::get('/AddPageGuid', [SiteSettingController::class, 'AddPageGuid'])->name('Add');
                Route::post('/deleteFile', [SiteSettingController::class, 'deleteFile'])->name('deleteFile');

                Route::post('/TurnOnOffFromHome', [SiteSettingController::class, 'TurnOnOffFromHome'])->name('TurnOnOffFromHome');

                Route::post('/updateGif1', [SiteSettingController::class, 'updateGif1'])->name('updateGif1');
                Route::post('/updateGif2', [SiteSettingController::class, 'updateGif2'])->name('updateGif2');
                Route::post('/updateguidProductPic', [SiteSettingController::class, 'updateguidProductPic'])->name('updateguidProductPic');
                Route::post('/updateguidVendorPic', [SiteSettingController::class, 'updateguidVendorPic'])->name('updateguidVendorPic');
                Route::post('/updateguidBuyPic', [SiteSettingController::class, 'updateguidBuyPic'])->name('updateguidBuyPic');

                Route::post('/aboute_usImg', [SiteSettingController::class, 'aboute_usImg'])->name('aboute_usImg');
                Route::post('/home_icon_laws', [SiteSettingController::class, 'home_icon_laws'])->name('home_icon_laws');
                Route::post('/home_icon_questions', [SiteSettingController::class, 'home_icon_questions'])->name('home_icon_questions');
                Route::post('/home_icon_Adds', [SiteSettingController::class, 'home_icon_Adds'])->name('home_icon_Adds');
                Route::post('/blogPic_news', [SiteSettingController::class, 'blogPic_news'])->name('blogPic_news');
                Route::post('/blogPic_share', [SiteSettingController::class, 'blogPic_share'])->name('blogPic_share');
                Route::post('/blogPic_Articles', [SiteSettingController::class, 'blogPic_Articles'])->name('blogPic_Articles');
                Route::post('/blogPic_guids', [SiteSettingController::class, 'blogPic_guids'])->name('blogPic_guids');

                Route::get('/SiteAdds', [SiteSidBarAddsController::class, 'edit'])->name('SiteAdds.edit');
                Route::post('/SiteAdds/store', [SiteSidBarAddsController::class, 'store'])->name('SiteAdds.store');
                Route::post('/SiteAdds/update', [SiteSidBarAddsController::class, 'update'])->name('SiteAdds.update');

                Route::post('/SiteAdds/delete', [SiteSidBarAddsController::class, 'delete'])->name('SiteAdds.delete');

            });

        Route::put('/updateArticle', [CategoryArticleController::class, 'UpdateArticle'])->name('UpdateArticle');

        Route::resource('/articleImages', ArtcilePicturesController::class);

        Route::get('/allComments', [ProductCommentsController::class, 'index'])->name('comments.index');
        Route::post('/destroyComment', [ProductCommentsController::class, 'destroy'])->name('comments.destroy');
        Route::post('/acceptComment', [ProductCommentsController::class, 'acceptComment'])->name('comments.acceptComment');

        Route::post('DeleteProduct', [AdminProductController::class, 'destroy'])->name('deleteProduct');

        Route::get('notifications', [userNotificationController::class, 'index'])
            ->middleware([MustVerified::class, RedirectVendorEnabled::class])
            ->name('notifications');

        Route::post('/AcceptProductByAdmin', [AdminProductController::class, 'acceptProduct'])->name('acceptProduct');

        Route::resource('sendMessage', MessageFromAdminController::class);

        Route::post('/Send', [MessageFromAdminController::class, 'SendWarningMassageToVendor'])->name('SendWarningMassageToVendor');

        Route::post('/MakeProductSpecial', [SpecialProductsController::class, 'MakeProductSpecial'])->name('MakeProductSpecial');
        Route::get('/SpecialProducts', [SpecialProductsController::class, 'getAll'])->name('allSpecialProducts');
        Route::post('/EditProductSpecial', [SpecialProductsController::class, 'EditProductSpecial'])->name('EditProductSpecial');
        Route::post('deleteFromSpecials', [SpecialProductsController::class, 'deleteFromSpecials'])->name('deleteFromSpecials');

        Route::post('/ladderProduct', [\App\Http\Controllers\Admin\ProductController::class, 'ladderProduct'])
            ->middleware([MustVerified::class, RedirectVendorEnabled::class])
            ->name('products.ladder');
        Route::post('/ladderVendor', [HomeVendorController::class, 'ladderVendor'])->name('ladderVendor');

        Route::prefix('products/{product}')
            ->name('products.')
            ->group(function () {
                Route::get('images-edit', [ProductImageController::class, 'edit'])->name('images.edit');
                Route::delete('images-destroy', [ProductImageController::class, 'destroy'])->name('images.destroy');
                Route::put('images-set-primary', [ProductImageController::class, 'setPrimaryByAdmin'])->name('images.set_primary');
                Route::get('category-edit', [ProductController::class, 'editCategory'])->name('category.edit');
                Route::put('category-update', [ProductController::class, 'updateCategory'])->name('category.update');
                Route::get('/finalEdit', [UserProductController::class, 'finalEdit'])->name('finalEdit');
                Route::post('images-add', [ProductImageController::class, 'addImageByAdmin'])->name('imageadd');
                // Route::any('images-add', [ProductImageController::class, 'addNewBYajax'])->name('addNewBYajax');
            });

        Route::post('/MakeVendorSpecial', [SpecialVendorsController::class, 'MakeVendorSpecial'])->name('MakeVendorSpecial');
        Route::get('/SpecialVendors', [SpecialVendorsController::class, 'getAll'])->name('AllSpecialVendors');
        Route::post('/EditSpecialVendor', [SpecialVendorsController::class, 'EditSpecialVendor'])->name('EditSpecialVendor');
        Route::post('deleteFromSpecialVendors', [SpecialVendorsController::class, 'deleteFromSpecialVendors'])->name('deleteFromSpecialVendors');

        Route::get('/EditHome', [SiteSettingController::class, 'EditHome'])->name('EditHome');
});

Route::prefix('verify')
    ->name('user.verify.')
    // ->middleware(MustVerified::class)
    ->group(function () {
        Route::get('/', [verifyUser::class, 'check_phone_page'])->name('index');
        Route::post('newCode', [verifyUser::class, 'request_code'])->name('request');
        Route::post('check', [verifyUser::class, 'check_code'])->name('check');
});

Route::prefix('vendor-dashboard')
    ->name('user.')
    ->middleware([isLogin::class, isUser::class, CheckUserPermission::class])
    ->group(function () {
        Route::get('/', [userVendorController::class, 'dashboard'])
            ->middleware([MustVerified::class, RedirectVendorEnabled::class])
            ->name('dashboard');

        Route::get("/contact_us" , [userVendorController::class , 'contact_us'])->name("contact_us");

        Route::get('/me/', [UserEmployeeController::class, 'me'])->name('me');
        Route::get('/SummaryOfOrders', [OrdersController::class, 'SummaryOfOrders'])->name('SummaryOfOrders');
        Route::get('/showUserDetail/{id}', [UserEmployeeController::class, 'showVendorUserDetail'])->name('showUserDetail');
        Route::post('/OfferCodeValidate', [OfferCodeController::class, 'OfferCodeValidate']);

        Route::get('/dashboard-help', [SiteSettingController::class, 'dashboardHelp'])->name('dashboardHelp');

        Route::resource('UserArticles', UserArticlesController::class);

        Route::post('/payAfterSend', [paymentController::class, 'payAfterSend'])->name('payAfterSend');

        Route::post('/payFromCredit', [paymentController::class, 'payAfterSend'])->name('payFromCredit');

        Route::get('/pay/{id}', [paymentController::class, 'payPage'])->name('payPage');

        Route::get('/profile', [userVendorController::class, 'profile'])->name('profile');

        Route::post('/ladderVendor', [HomeVendorController::class, 'ladderVendor'])->name('ladderVendor');

        Route::get('/inbox', [ProductCommentsController::class, 'inbox'])->name('inbox');
        Route::get('/resetPassword', [ResetPasswordController::class, 'go_to_reset_pass'])->name('go_to_reset_pass');
        Route::post('/reset-pass-forrm', [ResetPasswordController::class, 'final_reset_pass'])->name('final_reset_pass');
        // Route::get('/favorite', [FavoriteController::class, 'index']);

        Route::get('/sendProductToSlier/{id}', [SlidersController::class, 'sendProductToSlierPage'])->name('sendProductToSlierPage');

        Route::get('/vendorSlider', [SlidersController::class, 'vendorSliedrPage'])->name('vendorSliedrPage');

        Route::get('/vendorSliedrEditPage/{id}', [SlidersController::class, 'vendorSliedrEditPage'])->name('vendorSliedrEditPage');

        Route::post('/editVendorSlider', [SlidersController::class, 'editVendorSlider'])->name('editVendorSlider');

        Route::post('/sendVendorSlider', [SlidersController::class, 'sendVendorSlider'])->name('sendVendorSlider');

        Route::post('/DeleteSlider', [SlidersController::class, 'deleteSlider'])->name('deleteSlider');

        Route::post('/sendSlider', [SlidersController::class, 'sendUserProductSlider'])->name('sendProductSlider');

        Route::get('/mySliders', [SlidersController::class, 'mysliders'])->name('mysliders');

        Route::get('/SpecialVendors', [SpecialVendorsController::class, 'Userindex'])->name('SpecialVendors.index');

        Route::get('/SpecialVendors/create', [SpecialVendorsController::class, 'create'])->name('SpecialVendors.create');

        Route::post('/SpecialVendors/store', [SpecialVendorsController::class, 'store'])->name('SpecialVendors.store');

        Route::get('/Orders', [OrdersController::class, 'index'])->name('orders.index');
        Route::post('increaseCredit', [OrdersController::class, 'increaseCredit'])->name('increaseCredit');

        Route::get('/orderResponse', [OrdersController::class, 'response'])->name('orders.response');

        Route::get('/order/show/{id}', [OrdersController::class, 'show'])->name('orders.show');
        Route::get('/order/pdf/{id}', [OrdersController::class, 'pdf'])->name('orders.pdf');

        Route::prefix('/favorites')
            ->name('favorites.')
            ->group(function () {
                Route::get('/', [\App\Http\Controllers\User\FavoriteController::class, 'index'])->name('index');
                Route::get('/vendors', [\App\Http\Controllers\User\FavoriteController::class, 'vendors'])->name('vendors');
                Route::get('/products', [\App\Http\Controllers\User\FavoriteController::class, 'products'])->name('products');
                Route::get('/articles', [\App\Http\Controllers\User\FavoriteController::class, 'articles'])->name('articles');
                Route::get('/stories', [\App\Http\Controllers\User\FavoriteController::class, 'storiesInDashboard'])->name('stories');
                Route::post('/deleteFromFAvorite', [\App\Http\Controllers\User\FavoriteController::class, 'delete']);
            });

        Route::prefix('/story')
            ->name('story.')
            ->group(function () {
                Route::get('/', [StoryController::class, 'userindex'])->name('index');
                Route::get('/edit/{id}', [StoryController::class, 'edit'])->name('edit');
                Route::put('/update', [StoryController::class, 'update'])->name('update');
                Route::get('/create/{productId}', [StoryController::class, 'create'])->name('create');
                Route::post('/store', [StoryController::class, 'store'])->name('store');
                Route::post('/destroy', [StoryController::class, 'destroy'])->name('destroy');
                Route::post('/restory', [StoryController::class, 'restory'])->name('restory');
                
            });

        Route::prefix('/upgradeproduct')
            ->name('upgradeproduct.')
            ->group(function () {
                Route::get('/', [\App\Http\Controllers\User\SpecialProductsController::class, 'index'])->name('index');
                Route::get('/create/{id}', [\App\Http\Controllers\User\SpecialProductsController::class, 'create'])->name('create');
                Route::post('/store', [\App\Http\Controllers\User\SpecialProductsController::class, 'MakeProductSpecial'])->name('store');
                Route::post('/deleteUpgeatedProduct', [SpecialProductsController::class, 'deleteUpgeatedProduct'])->name('deleteUpgeatedProduct');
            });

        Route::resource('products', userProductController::class)->middleware([MustVerified::class, RedirectVendorEnabled::class, CheckUserPermission::class]);
      
        Route::post('/pinproducts', [userProductController::class, 'pinproducts'])->name('pinproducts');

      
        Route::resource('vendor', userVendorController::class)->middleware([MustVerified::class]);
        Route::get('/upgrade', [HomeVendorController::class, 'upgrade'])->name('upgrade');
        Route::get('/upgradeVendor', [HomeVendorController::class, 'upgradeVEndor'])->name('upgradeVEndor');

        Route::get('comments', [ProductCommentsController::class, 'userIndex'])->name('comments');

        Route::get('/create', [TicketController::class, 'create'])->name('tickets.createNew');
        Route::get('/tickets', [TicketController::class, 'userIndex'])->name('tickets.userIndex');
        Route::get('/ticket/{id}', [TicketController::class, 'Usershow'])->name('tickets.show');

        Route::post('/UseranswerTicket', [TicketController::class, 'UserAnswer'])->name('tickets.answer');
        Route::post('/UserCloseTicket', [TicketController::class, 'UserCloseTicket'])->name('tickets.close');

        //ladder product = nardeban

        Route::post('/ladderProduct', [UserProductController::class, 'ladderProduct'])
            ->middleware([MustVerified::class, RedirectVendorEnabled::class])
            ->name('products.ladder');
        Route::resource('Employees', UserEmployeeController::class);
        Route::get('/userLogs/{userId}', [UserEmployeeController::class, 'EmployeesLogs'])->name('Employees.logs');

        // Edit Vendor Image
        Route::prefix('vendor/{vendor:name}')
            ->name('vendor.')
            ->middleware([MustVerified::class, UserAccessVendor::class])
            ->group(function () {

                Route::get('edit', [VendorImageController::class, 'edit'])
                    ->middleware([MustVerified::class])
                    ->name('images.edit');

                Route::get('edit-coover', [VendorImageController::class, 'GoToEditCover'])->name('GoToEditCover');

                Route::post('/update-cover', [VendorImageController::class, 'setCover'])
                    ->middleware([MustVerified::class])
                    ->name('update-cover');

                Route::POST('images-set-avatar', [VendorImageController::class, 'setAvatar'])
                    ->middleware([MustVerified::class])
                    ->name('images.set_avatar');
            });

        Route::prefix('products/{product}')
            ->name('products.')
            ->middleware([MustVerified::class, RedirectVendorEnabled::class])
            ->group(function () {
                Route::get('images-edit', [ProductImageController::class, 'edit'])->name('images.edit');
                Route::delete('images-destroy', [ProductImageController::class, 'destroy'])->name('images.destroy');
                Route::put('images-set-primary', [ProductImageController::class, 'setPrimary'])->name('images.set_primary');
                Route::get('category-edit', [ProductController::class, 'editCategory'])->name('category.edit');
                Route::put('category-update', [ProductController::class, 'updateCategory'])->name('category.update');
                Route::get('/finalEdit', [UserProductController::class, 'finalEdit'])->name('finalEdit');
                Route::get('/finalSubmitCreatingProduct/{id}', [UserProductController::class, 'finalSubmitCreatingProduct'])->name('finalSubmitCreatingProduct');
                Route::post('images-add', [ProductImageController::class, 'addNeww'])->name('imageadd');
                // Route::any('images-add', [ProductImageController::class, 'addNewBYajax'])->name('addNewBYajax');
            });

        Route::prefix('/follow')
            ->name('follow.')
            ->middleware([MustVerified::class, RedirectVendorEnabled::class])

            ->group(function () {
                Route::get('/', [FollowController::class, 'index'])->name('mainP');

                Route::get('/followers', [FollowController::class, 'followersIndex'])->name('followers.index');

                Route::get('/followings', [FollowController::class, 'followingsIndex'])->name('followings.index');

                Route::post('/follow', [FollowController::class, 'follow'])->name('follow');
                Route::post('/unfollow', [FollowController::class, 'unfollow'])->name('unfollw');
            });

        Route::post('DeleteProduct', [ProductController::class, 'destroy'])->name('deleteProduct');
        Route::post('/delete-primary-image', [ProductImageController::class, 'deletePrimaryImage'])->name('deletePrimary');

        Route::post('createBrand', [BrandController::class, 'createByUser'])->name('createBrand');
        Route::post('createBrand2', [BrandController::class, 'createByUser2'])->name('createBrand2');

        Route::post('createTag', [TagController::class, 'createByUser'])->name('createTag');

        Route::get('/messages', [MessageFromAdminController::class, 'getMessages'])
            ->middleware([MustVerified::class, RedirectVendorEnabled::class])
            ->name('allmassages');

        Route::get('/category-attributes/{category}', [CategoryController::class, 'getCategoryAttributes'])
            ->middleware([MustVerified::class, RedirectVendorEnabled::class])
            ->name('getCatAtrr');

        Route::get('notifications', [userNotificationController::class, 'index'])
            ->middleware([MustVerified::class, RedirectVendorEnabled::class])
            ->name('notifications');

        // Route::resource('credit')

});

Route::prefix('/favorite')
    ->name('favorite.')
    ->group(function () {
        Route::get('/', [FavoriteController::class, 'products'])->name('index');

        Route::get('/vendors', [FavoriteController::class, 'vendors'])->name('vendors');
        Route::get('/products', [FavoriteController::class, 'products'])->name('products');
        Route::get('/articles', [FavoriteController::class, 'articles'])->name('articles');
        Route::get('/stories', [FavoriteController::class, 'FavoriteStories'])->name('stories');

        Route::post('/save', [FavoriteController::class, 'save'])->name('save');
        Route::post('/deleteFromFAvorite', [FavoriteController::class, 'delete']);

});

Route::post('/AddToComparison', [FavoriteController::class, 'AddTOCompare']);
Route::get('/compare', [FavoriteController::class, 'list'])->name('compare.index')->middleware([VisitCount::class]);
Route::post('/deleteFromComp', [FavoriteController::class, 'deleteFromComp']);

Route::get('/search', [SearchSearchController::class, 'search'])->name('search')->middleware([VisitCount::class]);

Route::post('/SearchProductAjax', [SearchSearchController::class, 'searchAjax_product'])->name('searchAjax_product');
Route::post('/searchVendorsAjax', [SearchSearchController::class, 'searchAjax_vendors'])->name('searchAjax_vendors');
Route::post('/searchBrandsAjax', [SearchSearchController::class, 'searchAjax_brands'])->name('searchAjax_brands');
Route::get('/searchProductInAllCats', [SearchSearchController::class, 'search_product_in_all_cats'])->name('search_product_in_all_cats')->middleware([VisitCount::class]);

Route::post('/getCategoryChildrens', [CategoryController::class, 'getCategoryChildrens'])->name('getCategoryChildrens');

// Route::get('/AllProducts', [ProductController::class, 'index'])->name('AllProducts.index')->middleware([VisitCount::class]);
// Route::get('/products', [ProductController::class, 'index'])->name('Products.index')->middleware([VisitCount::class]);
Route::get('/stores', [HomeVendorController::class, 'list'])->name('Vendors.list')->middleware([VisitCount::class]);
Route::get('/brands', [BrandController::class, 'HomeIndex'])->name('brands.homeIndex')->middleware([VisitCount::class]);
Route::get('/categories', [HomeCategoryController::class, 'index'])->name('categories.index')->middleware([VisitCount::class]);
Route::get('/brands/{brand}', [BrandController::class, 'showByBrand'])->name('showByBrand')->middleware([VisitCount::class]);

Route::get('stores/{vendor:name}/', [HomeVendorController::class, 'index'])->name('vendor.home');
Route::prefix('/products')
    ->name('products.')
    ->group(function () {
        

    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{product:slug}', [VendorsProductController::class, 'show'])->name('show');
});


Route::get('/{category:slug}', [HomeCategoryController::class, 'show'])->name('categories.show')->middleware([VisitCount::class]);

Route::get('/vendors/categories/{category:slug}', [HomeCategoryController::class, 'showVendors'])->name('vendors.categories.show')->middleware([VisitCount::class]);

Route::post('/VendorRate', [RateVendorController::class, 'save'])->name('ratevendor');

Route::post('/ProductRate', [RateProductController::class, 'save'])->name('ProductRate');
Route::post('/saveProductComment', [ProductCommentsController::class, 'save'])->name('saveProductComment');
Route::post('/AnswerComment', [ProductCommentsController::class, 'AnswerComment'])->name('AnswerComment');

Route::post('/update-cover', [VendorImageController::class, 'setCover'])
    ->middleware([MustVerified::class])
    ->name('update-cover');

Route::post('/delete-cover', [VendorImageController::class, 'deleteCover'])
    ->middleware([MustVerified::class])
    ->name('delete-cover');
Route::POST('images-set-avatar', [VendorImageController::class, 'setAvatar'])
    ->middleware([MustVerified::class])
    ->name('images.set_avatar');
Route::post('/searchCategoryAjax', [CategoryController::class, 'searchAjax']);
Route::post('/SearchBrandsAjax', [BrandController::class, 'SearchBrandsAjax']);
Route::post('/reloadCaptch', [CaptchaController::class, 'reload']);

Route::post('/getstories', [StoryController::class, 'ajaxGetVendorsStory']);
Route::post('/MyStories', [StoryController::class, 'ajaxGetMyStories']);





        // Route::get('/categories/{category:slug}', [VendorsCategoryController::class, 'show'])->name('categories');

        

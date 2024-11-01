<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorefavoriteRequest;
use App\Http\Requests\UpdatefavoriteRequest;
use App\Models\Admin\CategoryArticle;
use App\Models\favorite;
use App\Models\Product;
use App\Models\Vendor;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            $all = Auth::user()->vendor->favorites;
            $Articles = Auth::user()->vendor->favorites->whereNotNull('categoryArticle_id');
            $vendors = Auth::user()->vendor->favorites->whereNotNull('vendor_iddd');
            $products = resolve(ProductRepository::class)->getAuthFavoritedProduct();
            $stories = Auth::user()->vendor->favorites->whereNotNull('story_id');




            return view('ListOf.favorite.products', compact('all', 'Articles', 'vendors', 'products', 'stories'));
        } else {









            return view('ListOf.favorite.guest');
        }
    }

    public function save(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'id' => 'required',
        ]);
        if (Auth::user()) {

            try {
                if ($this->check($request->type, $request->id) == '1') {
                    return response()->json('you have benn selected this item as your favorite', 402);
                } else {
                    switch ($request->type) {
                        case 'product':
                            favorite::create([
                                'vendor_id' => Auth::user()->vendor->id,
                                'product_id' => $request->id,
                            ]);

                            break;
                        case 's':
                            favorite::create([
                                'vendor_id' => Auth::user()->vendor->id,
                                'story_id' => $request->id,
                            ]);
                            break;
                        case 'vendor':
                            favorite::create([
                                'vendor_id' => Auth::user()->vendor->id,
                                'vendor_iddd' => $request->id,
                            ]);

                            break;

                        case 'category':
                            favorite::create([
                                'vendor_id' => Auth::user()->vendor->id,
                                'categoryArticle_id' => $request->id,
                            ]);
                            break;

                        default:
                            break;
                    }
                    DB::commit();

                    return response()->json('ok', 200);
                }
            } catch (Exception $e) {
                return response()->json('erroe', 401);
            }
        } else {


            switch ($request->type) {
                case 'product':





                    $product = Product::find($request->id);

                    $fp = Session::get('favorite_p');
                    if (!$fp) {
                        $new = [
                            [
                                'id' => $request->id,
                                'product' => $product,
                            ],
                        ];
                        Session::put('favorite_p', $new);
                        return response()->json('1', 202);
                    } else {


                        $counter = 0;


                        foreach ($fp as $item) {

                            if ($item['id'] == $product->id) {
                                $counter++;
                            }
                        }


                        if ($counter == 0) {

                            array_push($fp, [
                                'id' => $request->id,
                                'product' => $product,
                            ]);

                            Session::put('favorite_p', $fp);
                        } else {
                            return response()->json('added to favorite before', 401);
                        }
                    }

                    break;
                case 's':
                    $fs = Session::get('favorite_s');

                    break;
                case 'vendor':



                    $vendor = Vendor::find($request->id);

                    $fv = Session::get('favorite_v');
                    if (!$fv) {
                        $new = [
                            [
                                'id' => $request->id,
                                'vendor' => $vendor,
                            ],
                        ];
                        Session::put('favorite_v', $new);
                        return response()->json('1', 202);
                    } else {


                        $counter = 0;


                        foreach ($fv as $item) {

                            if ($item['id'] == $vendor->id) {
                                $counter++;
                            }
                        }


                        if ($counter == 0) {

                            array_push($fv, [
                                'id' => $request->id,
                                'vendor' => $vendor,
                            ]);

                            Session::put('favorite_v', $fv);
                        } else {
                            return response()->json('added to favorite before', 401);
                        }
                    }


                    break;

                case 'category':

                    $article = CategoryArticle::find($request->id);

                    $fc = Session::get('favorite_c');



                    if (!$fc) {
                        $new = [
                            [
                                'id' => $request->id,
                                'article' => $article,
                            ],
                        ];
                        Session::put('favorite_c', $new);
                        return response()->json('1', 202);
                    } else {


                        $counter = 0;


                        foreach ($fc as $item) {

                            if ($item['id'] == $article->id) {
                                $counter++;
                            }
                        }


                        if ($counter == 0) {

                            array_push($fc, [
                                'id' => $request->id,
                                'article' => $article,
                            ]);

                            Session::put('favorite_c', $fc);
                        } else {
                            return response()->json('added to favorite before', 401);
                        }
                    }

                    break;

                default:
                    break;
            }



            return response(200);
        }
    }

    public function delete(Request $request)
    {
        if (Auth::user()) {
            $request->validate([
                'type' => 'required',
                'id' => 'required',
            ]);
            if ($this->check($request->type, $request->id) == '1') {
                $this->removeFromDatabase($request->id, $request->type, Auth::user()->vendor->id);
                return response()->json('ok', 202);
            } else {
                return response()->json('not found !!!', 402);
            }
        } else {






            $check = $this->checkFromSessions($request->type, $request->id);
            if ($check == "0") {
                return response()->json('not exist');
            } else {
                if ($this->removeFromSessions($request->type, $request->id) == "1") {
                    return response()->json('ok', 202);
                } else {
                    return response()->json('not found !!!', 402);
                }
            }
        }
    }


    public function checkFromSessions($type, $id)
    {
        switch ($type) {
            case 'product':

                $product = resolve(ProductRepository::class)->getSingle($id);
                $fp = Session::get('favorite_p');
                if (!is_null($fp)) {

                    $counter = 0;
                    foreach ($fp as $item) {

                        if ($item['id'] == $product->id) {
                            $counter++;
                        }
                    }

                    if ($counter > 0) {
                        return "1";
                    } else {
                        return "0";
                    }
                } else {
                    return "0";
                }
                break;
            case 's':

                break;
            case 'vendor':

                $vendor = Vendor::find($id);
                $fv = Session::get('favorite_v');
                if (!is_null($fv)) {

                    $counter = 0;
                    foreach ($fv as $item) {

                        if ($item['id'] == $vendor->id) {
                            $counter++;
                        }
                    }

                    if ($counter > 0) {
                        return "1";
                    } else {
                        return "0";
                    }
                } else {
                    return "0";
                }
                break;

            case 'category':

                break;

            default:
                break;
        }
    }


    public function check($type, $id)
    {
        $user_id = Auth::user()->vendor->id;

        switch ($type) {
            case 'product':
                if (
                    count(
                        favorite::where('vendor_id', $user_id)
                            ->where('product_id', $id)
                            ->get(),
                    ) > 0
                ) {
                    return '1';
                } else {
                    return '0';
                }
                break;
            case 's':
                if (
                    count(
                        favorite::where('vendor_id', $user_id)
                            ->where('product_id', $id)
                            ->get(),
                    ) > 0
                ) {
                    return '1';
                } else {
                    return '0';
                }
                break;
            case 'vendor':
                if (
                    count(
                        favorite::where('vendor_id', $user_id)
                            ->where('vendor_iddd', $id)
                            ->get(),
                    ) > 0
                ) {
                    return '1';
                } else {
                    return '0';
                }
                break;

            case 'category':
                if (
                    count(
                        favorite::where('vendor_id', $user_id)
                            ->where('categoryArticle_id', $id)
                            ->get(),
                    ) > 0
                ) {
                    return '1';
                } else {
                    return '0';
                }
                break;

            default:
                break;
        }

        DB::commit();
    }
    public function removeFromDatabase($id, $type, $userId)
    {
        switch ($type) {
            case 'product':
                favorite::where('vendor_id', $userId)
                    ->where('product_id', $id)
                    ->first()
                    ->delete();
                break;
            case 's':
                favorite::create([
                    'vendor_id' => Auth::user()->vendor->id,
                    'story_id' => $request->id,
                ]);
                break;
            case 'vendor':
                favorite::where('vendor_id', $userId)
                    ->where('vendor_iddd', $id)
                    ->first()
                    ->delete();
                break;

            case 'category':
                favorite::where('vendor_id', $userId)
                    ->where('categoryArticle_id', $id)
                    ->first()
                    ->delete();
                break;

            default:
                break;
        }
    }

    public function vendors()
    {
        if (Auth::user()) {
            $all = Auth::user()->vendor->favorites;
            $articles = Auth::user()->vendor->favorites->whereNotNull('categoryArticle_id');
            $vendors = Auth::user()->vendor->favorites->whereNotNull('vendor_iddd');
            $products = resolve(ProductRepository::class)->getAuthFavoritedProduct();
            $stories = Auth::user()->vendor->favorites->whereNotNull('story_id');
        } else {


            $products = $this->guestFavoritedProducts();

            $vendors = $this->guestFavoritedVendors();

            $articles = $this->guestFavoritedArticles();
        }
        $typeShow = 'vendors';

        return view('ListOf.favorite.guest', compact('products', 'vendors', 'articles', 'typeShow'));
    }

    public function products()
    {
        if (Auth::user()) {
            $all = Auth::user()->vendor->favorites;
            $articles = Auth::user()->vendor->favorites->whereNotNull('categoryArticle_id');
            $vendors = Auth::user()->vendor->favorites->whereNotNull('vendor_iddd');
            $products = resolve(ProductRepository::class)->getAuthFavoritedProduct();
            $stories = Auth::user()->vendor->favorites->whereNotNull('story_id');
            $typeShow = 'product';
        } else {


            $products = $this->guestFavoritedProducts();

            $vendors = $this->guestFavoritedVendors();

            $articles = $this->guestFavoritedArticles();


            $typeShow = 'product';
        }
        return view('ListOf.favorite.guest', compact('products', 'vendors', 'articles', 'typeShow'));
    }

    public function FavoriteStories()
    {
        $all = Auth::user()->vendor->favorites;
        $Articles = Auth::user()->vendor->favorites->whereNotNull('categoryArticle_id');
        $vendors = Auth::user()->vendor->favorites->whereNotNull('vendor_iddd');
        $products = resolve(ProductRepository::class)->getAuthFavoritedProduct();
        $stories = Auth::user()->vendor->favorites->whereNotNull('story_id');

        return view('ListOf.favorite.stories', compact('all', 'Articles', 'vendors', 'products', 'stories'));
    }

    public function articles()
    {
        if (Auth::user()) {
            $all = Auth::user()->vendor->favorites;
            $articles = Auth::user()->vendor->favorites->whereNotNull('categoryArticle_id');
            $vendors = Auth::user()->vendor->favorites->whereNotNull('vendor_iddd');
            $products = resolve(ProductRepository::class)->getAuthFavoritedProduct();
            $stories = Auth::user()->vendor->favorites->whereNotNull('story_id');
        } else {


            $products = $this->guestFavoritedProducts();

            $vendors = $this->guestFavoritedVendors();

            $articles = $this->guestFavoritedArticles();
        }

        $typeShow = 'articles';

        return view('ListOf.favorite.guest', compact('products', 'vendors', 'articles', 'typeShow'));
    }

    public function AddTOCompare(Request $request)
    {

        $request->validate([
            'id' => 'required',
        ]);

        $product = Product::find($request->id);

        session_start();

        $comp = Session::get('compList');

        if (!$comp) {
            $new = [
                [
                    'id' => $request->id,
                    'product' => $product,
                ],
            ];
            Session::put('compList', $new);
            return response()->json($comp, 202);
        } else {

            $exist  = false;
            
            foreach ($comp as $item) {
                if($item['id']== $request->id){
                    $exist = true;
                }
            }

 
   
            if(!$exist){
                
                array_push($comp, [
                    'id' => $request->id,
                    'product' => $product,
                ]);
    
                Session::put('compList', $comp);
    
                return response()->json($comp, 202);
            }
   
            return response()->json($comp, 400);
   
        }
   
    }

    public function list()
    {
        return view('home.comp.index');
    }

    public function deleteFromComp(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $comp = Session::get('compList');

        $myArray = [];

        $product = Product::find($request->id);
        $should_delete = [
            'id' => $request->id,
            'product' => $product,
        ];

        foreach ($comp as $item) {
            if ($item['id'] != $request->id) {
                array_push($myArray, $item);
            }
        }

        Session::put('compList', $myArray);

        return response()->json('deleted successfully', 202);
    }












    public function removeFromSessions($type, $id)
    {


        switch ($type) {
            case 'product':
                $fp = Session::get('favorite_p');

                if (!is_null($fp)) {


                    $myArray = [];

                    $product = Product::find($id);
                    $should_delete = [
                        'id' => $id,
                        'product' => $product,
                    ];

                    foreach ($fp as $item) {
                        if ($item['id'] != $id) {
                            array_push($myArray, $item);
                        }
                    }

                    Session::put('favorite_p', $myArray);

                    return "1";
                } else {
                    return "0";
                }


                break;

            case 'vendor':
                $fv = Session::get('favorite_v');

                if (!is_null($fv)) {


                    $myArray = [];

                    $vendor = Vendor::find($id);
                    $should_delete = [
                        'id' => $id,
                        'vendor' => $vendor,
                    ];

                    foreach ($fv as $item) {
                        if ($item['id'] != $id) {
                            array_push($myArray, $item);
                        }
                    }

                    Session::put('favorite_v', $myArray);

                    return "1";
                } else {
                    return "0";
                }


                break;

            case 'category':

                $fc = Session::get('favorite_c');

                if (!is_null($fc)) {


                    $myArray = [];

                    $article = CategoryArticle::find($id);
                    $should_delete = [
                        'id' => $id,
                        'article' => $article,
                    ];

                    foreach ($fc as $item) {
                        if ($item['id'] != $id) {
                            array_push($myArray, $item);
                        }
                    }

                    Session::put('favorite_c', $myArray);

                    return "1";
                } else {
                    return "0";
                }


                break;



            default:
                # code...
                break;
        }
    }



    function guestFavoritedProducts()
    {
        $fp = Session::get('favorite_p');


        $pids = [];

        if (!is_null($fp)) {

            foreach ($fp as $item) {
                array_push($pids, $item['id']);
            }



            $products = resolve(ProductRepository::class)->getProductInArray($pids);
        } else {
            $products = null;
        }

        return $products;
    }


    function guestFavoritedVendors()
    {
        $fv = Session::get('favorite_v');


        $vids = [];

        if (!is_null($fv)) {

            foreach ($fv as $item) {
                array_push($vids, $item['id']);
            }



            $vendors = Vendor::whereIn('id', $vids)->where('adminVendor', 'no')->get();
        } else {
            $vendors = null;
        }


        return $vendors;
    }







    function guestFavoritedArticles()
    {
        if (!Session::has('favorite_c')) {

            return null;
        }

        $fa = Session::get('favorite_c');





        $Aids = [];

        if (!is_null($fa)) {

            foreach ($fa as $item) {
                array_push($Aids, $item['id']);
            }



            $articles = CategoryArticle::whereIn('id', $Aids)->get();
        } else {
            $articles = null;
        }


        return $articles;
    }
}

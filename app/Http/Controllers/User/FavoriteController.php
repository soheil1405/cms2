<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorefavoriteRequest;
use App\Http\Requests\UpdatefavoriteRequest;
use App\Models\favorite;
use App\Models\Product;
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



            $all = Auth::user()->vendor->favorites;
            $Articles = Auth::user()->vendor->favorites->whereNotNull('categoryArticle_id');

            
            $vendors = Auth::user()->vendor->favorites->whereNotNull('vendor_iddd');

            $products = resolve(ProductRepository::class)->getAuthFavoritedProduct();

            $stories = Auth::user()->vendor->favorites->whereNotNull('story_id');



            

            return view('user.favorites.products', compact('all', 'Articles', 'vendors', 'products', 'stories'));
        
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

        return response()->json('ok', 200);
            
            switch ($request->type) {
                case 'product':
                    

                    


                    // $product::find($request->id);

                    // $fp = Session::get('favorite_p');
                    // if (!$fp) {
                    //     $new = [
                        //         [
                    //             'id' => $request->id,
                    //             'product' => $product,
                    //         ],
                    //     ];
                    //     Session::put('favorite_p', $new);
                    //     return response()->json($new, 202);
                    // } else {
                    //     array_push($fp, [
                        //         'id' => $request->id,
                    //         'product' => $product,
                    //     ]);

                    //     Session::put('favorite_p', $fp);
                        
                    //     return response()->json($fp, 202);
                    // }
                    
                    break;
                case 's':
                    $fs = Session::get('favorite_s');
                    
                    break;
                    case 'vendor':
                    
                        $fv = Session::get('favorite_v');
                        
                        
                        break;

                        case 'category':
                    $fc = Session::get('favorite_c');
                    
                    break;
                    
                default:
                break;
            }
            
            
            

            
            
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
        $all = Auth::user()->vendor->favorites;
        $Articles = Auth::user()->vendor->favorites->whereNotNull('categoryArticle_id');
        $vendors = Auth::user()->vendor->favorites->whereNotNull('vendor_iddd');
        $products = resolve(ProductRepository::class)->getAuthFavoritedProduct();
        $stories = Auth::user()->vendor->favorites->whereNotNull('story_id');

        return view('user.favorites.vendors', compact('all', 'Articles', 'vendors', 'products', 'stories'));
    }

    public function products()
    {

            $all = Auth::user()->vendor->favorites;
            $Articles = Auth::user()->vendor->favorites->whereNotNull('categoryArticle_id');
            $vendors = Auth::user()->vendor->favorites->whereNotNull('vendor_iddd');
            $products = resolve(ProductRepository::class)->getAuthFavoritedProduct();
            $stories = Auth::user()->vendor->favorites->whereNotNull('story_id');

            // dd($products);
            return view('user.favorites.products', compact('all', 'Articles', 'vendors', 'products', 'stories'));
       
    }

    public function storiesInDashboard()
    {

        $all = Auth::user()->vendor->favorites;
        $Articles = Auth::user()->vendor->favorites->whereNotNull('categoryArticle_id');
        $vendors = Auth::user()->vendor->favorites->whereNotNull('vendor_iddd');
        $products = resolve(ProductRepository::class)->getAuthFavoritedProduct();
        $stories = Auth::user()->vendor->favorites->whereNotNull('story_id');

        return view('user.favorites.stories', compact('all', 'Articles', 'vendors', 'products', 'stories'));
    }

    public function articles()
    {
        $all = Auth::user()->vendor->favorites;
        $Articles = Auth::user()->vendor->favorites->whereNotNull('categoryArticle_id');
        $vendors = Auth::user()->vendor->favorites->whereNotNull('vendor_iddd');
        $products = resolve(ProductRepository::class)->getAuthFavoritedProduct();
        $stories = Auth::user()->vendor->favorites->whereNotNull('story_id');

        return view('user.favorites.articles', compact('all', 'Articles', 'vendors', 'products', 'stories'));
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
}

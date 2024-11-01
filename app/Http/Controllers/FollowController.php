<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function index()
    {

        // dd(Auth::user()->vendor->systemFollow);

        dd(Auth::user()->vendor->sysFollowing);

    }



    public function followersIndex(){

        $Allfollowers = Follow::where('following' , Auth::user()->vendor->id)->get();

        // dd($Allfollowers);

        return view('user.follow.followers' , compact('Allfollowers'));


    }



    public function followingsIndex(){
        
        $Allfollowings = Follow::where('vendor_id' , Auth::user()->vendor->id)->get();


        // dd($Allfollowings[0]->vendor2);

        return view('user.follow.following' , compact('Allfollowings'));

    }










    public function follow(Request $request)
    {

            $request->validate([

                'id' => 'required',
            ]);

            $vendor = Auth::user()->vendor;

            if (count($vendor->followedOrNot($request->id)) < 1 && $vendor->id != $request->id) {

                $follow = follow::create([
                    'vendor_id' => $vendor->id,
                    'following' => $request->id,
                ]);

                if ($follow) {

                    $this->increaseFollowers($request->id);
                    $this->increaseFollowing($vendor->id);

                }

                DB::commit();

                return response()->json("followed" ,200);
            }
            
            return response()->json("failed" , 400);
            ;


    }

    public function unfollow(Request $request)
    {


        
            $request->validate([

                'id' => 'required',
            ]);

            $id = $request->id;
            $vendor = Auth::user()->vendor;

            $follow = $vendor->following;

            // return response()->json($follow);

            
            
            if (is_null($follow)) {
                return response()->json('you  has not follow this vendor');
            } else {

                foreach ($follow as $flw) {
               
                    if($flw->following == $id){
                        $flw->delete();
                    } 
                    
                }

                DB::commit();

                return response()->json("unfollowed" ,200);
            }


            return response()->json("failed" ,400);
        
        }

    public function increaseFollowers($id)
    {

        $vendor = Vendor::find($id);
        $count = $vendor->follower_count + 1;
        $vendor->update([
            'follower_count' => $count,
        ]);

    }
    public function decreaseFollowers($id)
    {

        $vendor = Vendor::find($id);
        $count = $vendor->follower_count - 1;
        $vendor->update([
            'follower_count' => $count,
        ]);
    }

    public function increaseFollowing($id)
    {

        $vendor = Vendor::find($id);
        $count = $vendor->following_count + 1;
        $vendor->update([
            'following_count' => $count,
        ]);
    }

    public function decreaseFollowing($id)
    {

        $vendor = Vendor::find($id);
        $count = $vendor->following_count - 1;
        $vendor->update([
            'following_count    ' => $count,
        ]);
    }

}

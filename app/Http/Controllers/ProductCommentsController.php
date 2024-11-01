<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Admin\ProductComments;
use App\Models\Product;
use App\Models\Vendor;
use App\Repositories\AdminMessageRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCommentsController extends Controller
{
    public function index()
    {
        $AllComments = ProductComments::orderBy('is_active', 'asc')->latest()->get();

        $new_comments = ProductComments::where('is_active', 0)->get();

        return view('admin.comments.index', compact('AllComments', 'new_comments'));
    }

    public function userIndex()
    {

        $comments = ProductComments::where('vendor_id', Auth::user()->vendor->id)->where('is_active', 1)->latest()->get();



        foreach ($comments as $item) {
            $item->update([
                'seenOrNot' => 1,
            ]);


        }

        DB::commit();

        return view('user.comments.index', compact('comments'));

    }

    public function save(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'product_id' => 'nullable',
            'username' => 'required',
            'comment' => 'required',
            'vendor_id' => 'required',
            'number' => 'digits:11',
            'captcha' => 'required|captcha',

        ]);

        try {


            $comment = ProductComments::create([
                'product_id' => $request->product_id,
                'username' => $request->username,
                'comment' => $request->comment,
                'vendor_id' => $request->vendor_id,
                'email' => $request->email,
                'number' => $request->number,
            ]);

            if (Auth::user()) {

                $user = Auth::user();

                if ($user->vendor && $user->vendor->id == $request->vendor_id) {
                    $comment->update([
                        'username' => $user->vendor->name,
                        'is_active' => "1",
                        'seenOrNot' => "1",
                    ]);
                    session()->flash('SaveCommentSuccessfully', 'کامنت شما با موفقیت ذخیره شد ... ');
                } elseif ($user->rols()->where('name', 'admin')->get()->count() > 0) {

                    $comment->update([
                        'username' => "instabargh",
                        'is_active' => "1",
                        'seenOrNot' => "1",
                    ]);

                    session()->flash('SaveCommentSuccessfully', 'کامنت شما با موفقیت ذخیره شد ... ');

                }

            } else {

                session()->flash('SaveCommentSuccessfully', 'کامنت شما با موفقیت ذخیره شد و پس از تایید تهایی منتشر میشود ... ');
            }


            return redirect()
                ->back();

        } catch (Exception $e) {

            session()->flash('SaveCommentSuccessfully', ' ذخیره کامنت با شکست مواجه شد ');

            return redirect()
                ->back();

        }
    }

    public function AnswerComment(Request $request)
    {
        $request->validate([
            'answered_to' => 'required',
            'username' => 'required',
            'comment' => 'required',
            // 'captcha' => 'required|captcha',

        ]);

        // try {

        $parent = ProductComments::findOrFail($request->answered_to);

        if ($parent->MainParent == null) {

            $commentMainParent = $parent->id;

        } else {

            $commentMainParent = $parent->MainParent;

        }

        // dd(route('products.show', ['vendor' => $parent->vendor->name, 'product' => $parent->product->slug]));

        // dd(route('vendor.home', ['vendor' => $parent->vendor->name]));


        $comment = ProductComments::create([
            'product_id' => $request->product_id,
            'username' => $request->username,
            'comment' => $request->comment,
            'answered_to' => $parent->id,
            'answered_to_name' => $parent->username,
            'MainParent' => $commentMainParent,
            'vendor_id' => $parent->vendor_id,
            'email' => $request->email ? $request->email : null,
        ]);

        if (Auth::user()) {

            $user = Auth::user();

            if ($user->vendor && $user->vendor->id == $parent->vendor_id) {
                $comment->update([
                    'username' => $user->vendor->name,
                    'is_active' => "1",
                    'seenOrNot' => "1",
                ]);
                alert()->success('  پاسخ شما با موفقیت ثبت شد  ', 'باتشکر');

                $this->sendAnswerEmail($parent, 'فروشگاه');
            } elseif ($user->rols()->where('name', 'admin')->get()->count() > 0) {

                $comment->update([
                    'username' => "instabargh",
                    'is_active' => "1",
                    'seenOrNot' => "1",
                ]);

                $this->sendAnswerEmail($parent, "ادمین");
            } else {
                session()->flash('SaveCommentSuccessfully', 'کامنت شما با موفقیت ذخیره شد و پس از تایید تهایی منتشر میشود ... ');

                return redirect()
                    ->back();
            }

        }
        session()->flash('SaveCommentSuccessfully', 'کامنت شما با موفقیت ذخیره شد ... ');

        return redirect()
            ->back();

        // } catch (Exception $e) {
        //     return redirect()->back()->with(['SaveCommenterror' => 'ذخیره کامنت با شکست مواجه شد ']);
        // }
    }

    public function acceptComment(Request $request)
    {

        // try{
        $request->validate([
            'id' => 'required',
        ]);

        $comment = ProductComments::find($request->id);

        $comment->update([
            'is_active' => 1,
        ]);

        resolve(AdminMessageRepository::class)->SendAcceptCommenrMessage($comment);

        DB::commit();
        return redirect()->route('admin.comments.index');

        // }catch(Exception $e){

        // }

    }

    public function destroy(Request $request)
    {

        try {
            $request->validate([
                'id' => 'required',
            ]);

            $comment = ProductComments::find($request->id);

            foreach ($comment->answers as $answer) {

                $answer->delete();

            }

            $comment->delete();

            DB::commit();
            return redirect()->route('admin.comments.index');

        } catch (Exception $e) {

        }

    }

    public function inbox()
    {

        $unreadMassages = Auth::user()->vendor->unreadMassages;

        foreach ($unreadMassages as $m) {
            $m->update([

                'seen_at' => Carbon::now(),

            ]);
        }

        $messages = Auth::user()->vendor->AdminMassages;

        return view('user.layouts.inbox', compact('messages'));
    }

    public function sendAnswerEmail($parent, $who)
    {
        if ($parent->email) {
            $email = $parent->email;
            if ($parent->product) {

                $details = [
                    'email' => $email,
                    'msg' => 'کامنت شما توسط ' . $who . ' در سایت اینستابرق پاسخ داده شد  ، جهت مشاهده لینک زیر را دنبال کنید (instabargh)',
                    'link' => route('products.show', ['vendor' => $parent->vendor->name, 'product' => $parent->product->slug]),
                ];

            } else {

                $details = [
                    'email' => $email,
                    'msg' => 'کامنت شما  توسط ' . $who . 'در سایت اینستابرق پاسخ داده شد  ، جهت مشاهده لینک زیر را دنبال کنید (instabargh)',
                    'link' => route('vendor.home', ['vendor' => $parent->vendor->name]),
                ];

            }


            dispatch(new SendEmailJob($details));

        }

    }

}
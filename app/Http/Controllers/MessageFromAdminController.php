<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageFromAdminRequest;
use App\Http\Requests\UpdateMessageFromAdminRequest;
use App\Models\MessageFromAdmin;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\Vendor;
use App\Repositories\AdminMessageRepository;
use Illuminate\Http\Request;

class MessageFromAdminController extends Controller
{



    public function edit(Request $request , $messageFromAdmin)
    {


        if($request->vendor){

            $vendor = Vendor::findOrFail($request->vendor);
            return view('admin.vendors.ReportVendors' , compact('vendor' ));

        }else{

            $product = Product::find($messageFromAdmin);
            $product_id = $product->id;
       
        }        
        




        return view('admin.products.ReportProduct' , compact('product' , 'product_id' ));
    }


    public function SendWarningMassageToVendor(Request $request){

        
        if($request->subject == "vendor"){
            $vendor = Vendor::findOrFail($request->subjectId);


            $massage = "   :  کاربر گرامی فروشگاه شما به دلیل   ";
    

        }elseif($request->subject == "slider"){

            $slider = Sliders::findOrFail($request->subjectId);



            $massage = "   :  کاربر گرامی اسلایدر شما به دلیل   ";
    
        } else{

            
            $product = Product::findOrFail($request->subjectId);

            $massage = "   ':  کاربر گرامی محصول'  .$product->name . 'به دلیل  ' ";
    
        }


    
        switch($request->reason){

            case 'laws':
                $massage = $massage . 'عدم رعایت قوانین و مقررات';
                break;
                

            case 'pic':
                $massage = $massage . 'عکس های غیر مرتبط با محصول';
                break;
                
            case 'WrongDetail':
                $massage = $massage . 'درج اطلاعات اشتباه در محصول';
                break;
            case 'Cat':
                $massage = $massage . 'انتخاب اشباه دسته بندی محصول';
                break;
            
        }

        $massage = $massage . 'رد شد .';



        if($request->msg){

            $massage = $massage."\n";
            $massage = $massage."توضیحات بیشتر" ."\n";
            $massage = $massage.$request->msg;

        }


        if($request->subject == "vendor"){
            $massage = resolve(AdminMessageRepository::class)->Report('v' ,$vendor->id , $vendor->id , $massage);

            $vendor->update([
                'status'=>'reported' ,
                'EditReportText' => $massage,
            ]);
    
        }elseif($request->subject == "slider"){

            $massage = resolve(AdminMessageRepository::class)->Report('s' ,$slider->id , $slider->vendor->id , $massage);

            $slider->update([
                'status'=>0 ,
                // 'acceptedbyAdmin'=>null
            ]);
        }else{
            $massage = resolve(AdminMessageRepository::class)->Report('p' ,$product->id , $product->vendor->id , $massage);

            $product->update([
                'status'=>'reported' ,
            ]);
    
        }


        


        return redirect()->route('admin.products.index');


        // dd(/$request->all());
    }

    public function getMessages(){

        
        return view('user.notification.messageInbox' );
    }
}

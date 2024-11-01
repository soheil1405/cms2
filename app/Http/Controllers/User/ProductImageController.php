<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\spareProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Image as ModelsImage;
use App\Repositories\AdminMessageRepository;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Auth;

class ProductImageController extends Controller
{
    public function upload($images , $product = null , $request = null , $vendorID = null)
    {
        $fileNameImages = [];

        if($request && $request->primaryImageType == "new"){
            $newImageIndex = $request->primaryImageName;
        }

        
        foreach ($images as  $key => $image) {
            if ($image) {
                $fileNameImage = generateFileName($image->getClientOriginalName());
            
                $image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')), $fileNameImage);
            
                array_push($fileNameImages, $fileNameImage);
    
                if($product){
                     $productImage =  ProductImage::create([
                        'image'=>$fileNameImage , 
                        'product_id' => $product->id,
                        'min_image'=> $fileNameImage
                    ]);
                     if (isset($newImageIndex) && $newImageIndex == $key){
                        $productImage->update([
                            'makeMainAfterAccept'=>$newImageIndex  ,
                        ]);
                     }
                }     
                if ($vendorID){
                    $image = ModelsImage::create([
                        'image'=>$fileNameImage ,
                        "vendor_id"=>$vendorID
                    ]);
                }
               
            }
        }

        return ['fileNameImages' => $fileNameImages];
    }


    public function GetNewWifthAndHeight($image , $fileNameImage){
      
        $width = getimagesize($image)[0];
        $height =getimagesize($image)[1];

    
        
            $width = $width/ 3;
        
            
            
            $height = $height/3;
        
            
            
        $destinationPath = public_path(env('PRODUCT_MIN_IMAGES_UPLOAD_PATH')) . $fileNameImage;
        $img = Image::make($image->path());
    
        // Resize the image
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath);
    
        return $fileNameImage;
    }


    public function edit(Product $product)
    {
        return view('user.products.edit_images', compact('product'));
    }

    public function destroy(Request $request, $productId)
    {
        $request->validate([
            'image_id' => 'required|exists:product_images,id',
        ]);

        $image = ProductImage::find($request->image_id);

        $product = Product::find($productId);

        $this->deleteImage($image->id , $product);

        alert()->success('تصویر محصول مورد نظر حدف شد', 'باتشکر');
        return redirect()->back();
    }

    public function setPrimary ( $imageName ,  Product $product)
    {

        $image = ProductImage::where("image" , $imageName)->first();

        if(!$image ){
            $imageName = "product-default-limage.jpg";
        }

         $product->update([
            'primary_image' => $imageName,
        ]);
        alert()->success('ویرایش تصویر اصلی محصول با موفقیت انجام شد', 'باتشکر');
        return redirect()->back();
    }



    public function addImageByAdmin(Request $request , Product $product){
       
            $this->addNeww($request->images , $product);

            alert()->success('ویرایش تصویر اصلی محصول با موفقیت انجام شد', 'باتشکر');
            return redirect()->back();
    
    }



    public function setPrimaryByAdmin(Request $request ,$productId ){
        $image = ProductImage::findOrFail($request->image_id);
        $product = Product::findOrFail($productId);
        $this->setPrimary($image->image , $product);
        return redirect()->back();
    }




    public function addNeww(  $images ,  Product $product)
    {
        // try {



        DB::beginTransaction();

        foreach ($images as $image) {



            

            $fileNameImage = generateFileName($image->getClientOriginalName());

            $image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')), $fileNameImage);

            // $img->save(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')), $fileNameImage);


            $imagesss = ProductImage::create([
                'product_id' => $product->id,
                'image' => $fileNameImage,
            ]);
        }



        $pImage = $product->Allimages;




        if ($product->primary_image == "product-default-limage.jpg" || $product->primary_image == null) {


            if ($product->status == "new") {
                $status = "new";
            } else {
                $status = "edited";

            }


            $product->update([
                'primary_image' =>  $pImage[0] ->image,
                'status' => $status

            ]);
        }

        DB::commit();




        // } catch (\Exception $ex) {
        //     DB::rollBack();
        //     alert()
        //         ->error('مشکل در ایجاد محصول', $ex->getMessage())
        //         ->persistent('حله');
        //     return redirect()->back();
        // }
    }

    public function deletePrimaryImage(Request $request)
    {
        $product = Product::find($request->product_id);

        $counter = 0;

        $images = $product->images;


        if (count($images) > 0) {
            $product->update([

                'primary_image' => $images[0]->image
            ]);



        } else {
            $product->update([

                'primary_image' => 'product-default-limage.jpg'
            ]);
        }



        alert()->success('ویرایش تصویر اصلی محصول با موفقیت انجام شد', 'باتشکر');
        return redirect()->back();
    }

    public function addNewBYajax(Request $request, Product $product)
    {
        $image = base64_decode($request->image);
        $fileName = time() . '.jpeg';
        $path = public_path(env('PRODUCT_IMAGES_UPLOAD_PATH') . $fileName);

        Image::make(file_get_contents($request->cover))
            ->resize(800, 800)
            ->save($path);

        ProductImage::create([
            'product_id' => $product->id,
            'image' => $fileName,
        ]);

        if ($product->primary_image == 'product-default-limage.jpg') {
            $product->update([
                'primary_image' => $fileName,
            ]);
        }

        return response()->json($product, 200);
    }
}
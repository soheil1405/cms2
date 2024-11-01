<?php

namespace App\Repositories;

use App\Models\Admin\ProductComments;
use App\Models\Admin\SpecialProducts;
use App\Models\MessageFromAdmin;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\story;
use App\Models\Vendor;
use Carbon\Carbon;

class AdminMessageRepository
{

    //product
    public function SendEditMessage(Product $product)
    {

        $massage = 'محصول ' . $product->name . 'با موفقیت ویرایش شد و پس از تایید نهایی منتشر خواهد شد ...';

        MessageFromAdmin::create([

            'vendor_id' => $product->vendor_id,
            'subject' => 'ویرایش محصول',
            'subject_id' => $product->id,
            'message' => $massage,
        ]);



    }
    public function SendAcceptProductMessage(Product $product)
    {

        $massage = 'محصول ' . $product->name . 'با موفقیت منتشر شد  ...';

        MessageFromAdmin::create([

            'vendor_id' => $product->vendor_id,
            'subject' => 'تایید محصول',
            'subject_id' => $product->id,
            'message' => $massage,
        ]);

        $product->update([
            'status' => 'yes',
        ]);

    }

    public function sendCreateProductMessage(Product $product)
    {

        $massage = 'محصول ' . $product->name . 'با موفقیت ایحاد شد و پس از تایید نهایی منتشر خواهد شد ...';

        MessageFromAdmin::create([

            'vendor_id' => $product->vendor_id,
            'subject' => 'ویرایش محصول',
            'subject_id' => $product->id,
            'message' => $massage,
        ]);

        $product->update([
            'status' => 'new',
        ]);
    }

    public function sendReportProductMessage(Product $product)
    {
        $massage = 'محصول '
            .
            $product->name
            .
            '  به دلیل عدم رعایت قوانین اینستابرق رد شد ....'
        ;

        MessageFromAdmin::create([

            'vendor_id' => $product->vendor_id,
            'subject' => 'رد محصول',
            'subject_id' => $product->id,
            'message' => $massage,
        ]);

        $product->update([
            'status' => 'reported',
        ]);

    }

    //vendor
    public function sendReportVendorMessage(Vendor $vendor)
    {

        $massage = '
        تفییرات جدید فروشگاه شما به دلیل عدم رعایت قوانین اینستابرق رد شد ...
        ';

        MessageFromAdmin::create([

            'vendor_id' => $vendor->id,
            'subject' => 'رد قزوشگاه',
            'subject_id' => $vendor->id,
            'message' => $massage,
        ]);

        $vendor->update([
            'status' => 'reported',
        ]);
    }

    public function sendAcceptVendorMessage(Vendor $vendor)
    {
        $massage = '

        تفییرات جدید فروشگاه شما با موفقیت ثبت شد ...

        ';

        MessageFromAdmin::create([

            'vendor_id' => $vendor->id,
            'subject' => 'تایید قزوشگاه',
            'subject_id' => $vendor->id,
            'message' => $massage,
        ]);

        $vendor->update([
            'status' => 'yes',
        ]);

    }

    public function sendEditVendorMessage(Vendor $vendor)
    {

        $massage =

            'فروشگاه شما با موفقیت ویرایش شد و پس از تایید نهایی منتشز خواهد شد ...'

        ;

        MessageFromAdmin::create([

            'vendor_id' => $vendor->id,
            'subject' => 'ویرایش فروشگاه',
            'subject_id' => $vendor->id,
            'message' => $massage,
        ]);

        if ($vendor->status == "no") {
            $status = "new";
        } else {
            $status = "edited";
        }


    }

    //comment

    public function SendAcceptCommenrMessage(ProductComments $productComments)
    {

        $comment = $productComments;

        $product = Product::find($productComments->product_id);

        if ($product) {
            $massage =
                'دیدگاه حدید برای محصول'
                .
                $product->neme
                .
                " : "
                .
                $comment->username . ":"
                .
                $comment->comment
            ;
            MessageFromAdmin::create([

                'vendor_id' => $product->vendor->id,
                'subject' => ' کامنت محصول ',
                'subject_id' => $product->id,
                'message' => $massage,
            ]);

        } else {

            $massage =
                'دیدگاه حدید برای فروشگاه شما :'
                .
                $comment->username . ":" .
                $comment->comment;

            MessageFromAdmin::create([
                'vendor_id' => $productComments->vendor_id,
                'subject' => ' کامنت فروشگاه ',
                'subject_id' => $productComments->vendor_id,
                'message' => $massage,
            ]);

        }

        $comment->update([
            'is_active' => 1,
        ]);

    }

    public function SendWellcomeText($vendorId)
    {
        $massage = "سلام کاربر  گزامی ...
        ضمن عرض خوش آمد گویی ,برای شما تجربه بهترین ها را در سایت اینستا برق آرزومندیم ...

        اینستابرق
        تنوع در خرید ، تحول در فر و ش
        ";
        $vendor = Vendor::find($vendorId);
        if ($vendor) {
            MessageFromAdmin::create([
                'vendor_id' => $vendorId,
                'subject' => 'خوش آمد گویی',
                'subject_id' => $vendorId,
                'message' => $massage,
            ]);
        }
    }

    //sliders

    public function CreateNewSlider(Sliders $sliders)
    {

        $massage = "اسلایدر شما با موفقیت ایجاد شد و پس از تایید نهایی منتشز خواهد شد";

        MessageFromAdmin::create([

            'vendor_id' => $sliders->vendor_id,
            'subject' => 'ایجاد اسلایدر',
            'subject_id' => $sliders->id,
            'message' => $massage,
        ]);

        $sliders->update([
            'acceptedbyAdmin' => null,
        ]);

    }

    public function EditSlider(Sliders $sliders)
    {
        $massage = "اسلایدر شما با موفقیت ویرایش شد و پس از تایید نهایی منتشز خواهد شد";

        MessageFromAdmin::create([

            'vendor_id' => $sliders->vendor_id,
            'subject' => 'ویزایش اسلایدر',
            'subject_id' => $sliders->id,
            'message' => $massage,
        ]);

        $sliders->update([
            'acceptedbyAdmin' => null,
        ]);

    }

    public function AcceptSlider(Sliders $sliders)
    {
        $from = \Morilog\Jalali\Jalalian::forge($sliders->from);

        $to = \Morilog\Jalali\Jalalian::forge($sliders->to);

        $massage = "اسلایدر شما توسظ اینستا برق تایید و از تاریخ" . $from . "تا تاریخ" . $to . "دز اسلایدز های اینستابرق قابل مشاهده می باشد";

        MessageFromAdmin::create([

            'vendor_id' => $sliders->vendor_id,
            'subject' => 'تایید اسلایدر',
            'subject_id' => $sliders->id,
            'message' => $massage,
        ]);

        $now = Carbon::now();

        $sliders->update([
            'acceptedbyAdmin' => $now,
        ]);

    }

    //upgrade Product by user

    public function CreateNewSpecialProduct(Product $product)
    {

        $massage = "محصول " . $product->name . 'با موفقیت به لیست محصولات ویژه اصافه شد و پس از تایید نهایی منتشز خواهد شد';

        MessageFromAdmin::create([

            'vendor_id' => $product->vendor_id,
            'subject' => 'ایجاد محصول ویژه',
            'subject_id' => $product->id,
            'message' => $massage,
        ]);

    }

    public function AcceptSpecialProduc(SpecialProducts $specialProducts)
    {
        $massage = "محصول " . $specialProducts->product->name . 'با موفقیت به لیست محصولات ویژه اصافه شد و پس از تایید نهایی منتشز خواهد شد';

        MessageFromAdmin::create([
            'vendor_id' => $specialProducts->product->vendor_id,
            'subject' => 'ایجاد محصول ویژه',
            'subject_id' => $specialProducts->product->id,
            'message' => $massage,
        ]);

        $now = Carbon::now();

        $specialProducts->update([
            'acceptedbyAdmin' => $now,
        ]);
    }

    //stories

    public function CreateStory(story $story)
    {
        $massage = "استوری شما با موفقیت ایجاد شد و پس از تایید نهایی منتشز خواهد شد";

        MessageFromAdmin::create([

            'vendor_id' => $story->vendor_id,
            'subject' => 'ایجاد استوزی',
            'subject_id' => $story->id,
            'message' => $massage,
        ]);

        $story->update([
            'acceptedbyAdmin' => null,
        ]);

    }

    public function EditStory(story $story)
    {
        $massage = "استوزی شما با موفقیت ویرایش شد و پس از تایید نهایی منتشز خواهد شد";

        MessageFromAdmin::create([

            'vendor_id' => $story->vendor_id,
            'subject' => 'ویزایش اسنوری',
            'subject_id' => $story->id,
            'message' => $massage,
        ]);

        $story->update([
            'acceptedbyAdmin' => null,
        ]); 

    }
    public function AcceptStory(story $story)
    {

        $massage = "اسلایدر شما توسظ اینستا برق تایید و منتشر شد";

        MessageFromAdmin::create([

            'vendor_id' => $story->vendor_id,
            'subject' => 'تایید اسنوری',
            'subject_id' => $story->id,
            'message' => $massage,
        ]);

        $now = Carbon::now();

        $story->update([
            'acceptedbyAdmin' => $now,
        ]);

    }

    public function SendMassageToFollowers($followers, $vendor, $product)
    {

        $massage = "فروشگاه " . $vendor->title . " محصول جدیدی منتشر کرد";

        $link = 'https://instabargh.com/' . $vendor->title . '/products/' . $product->slug;

        foreach ($followers as $follower) {

            if ($follower->vendor1) {

                MessageFromAdmin::create([

                    'vendor_id' => $follower->vendor1->id,
                    'subject' => 'محصول جدید فالوور',
                    'link' => $link,
                    'message' => $massage,
                ]);
            }

        }

    }

    public function Report($type, $id, $vid, $massage)
    {

        switch ($type) {

            case 'p':

                $massage = MessageFromAdmin::create([

                    'vendor_id' => $vid,
                    'subject' => 'ریپورت محصول',
                    'subject_id' => $id,
                    'message' => $massage,
                ]);

                break;


            case 'v':
                $massage = MessageFromAdmin::create([
                    'vendor_id' => $vid,
                    'subject' => 'ریپورت فروشگاه',
                    'subject_id' => $id,
                    'message' => $massage,
                ]);

                break;

            case 's':
                $massage = MessageFromAdmin::create([
                    'vendor_id' => $vid,
                    'subject' => 'ریپورت اسلایدر',
                    'subject_id' => $id,
                    'message' => $massage,
                ]);

                break;


            default:
                $massage = null;
                break;


        }


        return $massage;
    }

}
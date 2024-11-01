@extends('user.layouts.user')

@section('title')
    دنبال کننده ها
@endsection


@section('content')


    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                
                <h5 class="font-weight-bold mb-3 mb-md-0">
                    
                    لیست دنبال کننده ها 
                    
                    (آن ها شما را دنبال میکنند)
                    
                    ({{ count($Allfollowers) }})</h5>


                    <div class="">
                     
                        <a href="{{route('user.follow.followings.index')}}" class="btn btn-primary">دنبال شوندگان</a>
                        <a href="{{route('user.dashboard')}}" class="btn btn-primary">بازگشت</a>
                   
                    </div>
            </div>


            @if (Session::has('success'))
                <div class="alert alert-info">
                    <a class=" btn btn-danger close" data-dismiss="alert">×</a>
                    {!! Session::get('success') !!}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام فروشگاه </th>
                            <th> مدیر فروشگاه </th>
                            <th>دسته فعالیت </th>
                            <th> تعداد کالا </th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>

                    @for ( $i= 0 ; $i < count($Allfollowers) ; $i++)

                    
                    
                        <?php $products_count = count($Allfollowers[$i]->vendor1->products); 
                        
                        
                        if(!is_null($Allfollowers[$i]->vendor1->user )  && $Allfollowers[$i]->vendor1->user->id != "11" && $Allfollowers[$i]->vendor1->user->id != "12" ){


                        ?>

                        <a>
                            <tr>
                                <th>
                                    {{ $Allfollowers[$i]->vendor1->id }}
                                </th>
                                <th>
                                    <a href="{{ route('vendor.home', ['vendor' => $Allfollowers[$i]->vendor1->name]) }}">

                                        {{ $Allfollowers[$i]->vendor1->title }}

                                    </a>
                                </th>
                                <th>
                                    {{ $Allfollowers[$i]->vendor1->user->name }}
                                </th>
                                <th>


                                    <?php
                                    
                                    $data = str_replace('-', ' ', strval($Allfollowers[$i]->vendor1->category_activity));
                                    
                                    $d = explode('-', $Allfollowers[$i]->vendor1->category_activity);
                                    
                                    foreach ($d as $ddd) {
                                        $category = \App\Models\Category::find($ddd);
                                    
                                        if ($category) {
                                            echo '-' . $category->name;
                                            echo '</br>';
                                        }
                                    }
                                    
                                    ?>


                                </th>
                                <th>
                                    {{ $products_count }}
                                </th>
                                <th>

                                <a href="{{ route('vendor.home', ['vendor' => $Allfollowers[$i]->vendor1->name]) }}" class="btn btn-secondary">مشاهده فروشگاه</a>
                                </th>


                            </tr>
                        </a>


                        <?php } ?>
                    @endfor
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{-- {{ $brands->render() }} --}}
            </div>
        </div>
    </div>
@endsection





<style>
    table {
        font-size: 13px;
    }
</style>

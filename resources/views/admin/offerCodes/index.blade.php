@extends('admin.layouts.admin')


@section('title')
    OfferCodes
@endsection


@section('content')
    <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">

        <a class="btn btn-primary" href="{{route('admin.odderCodes.create')}}">ایجاد کد تخفیف</a>



        <div class="table-responsive">
        
        
            @if (Session::has('msg'))
                <div class="alert info">
                    {{Session::get('msg')}}
                </div>
            @endif


        
            <table class="table table-bordered table-striped text-center">



                <thead>


                    <tr>
                        <td>#</td>
                        <th>عنوان تخفیف </th>
                        <th>میزان تخفیف</th>
                        <th>کد تخفیف</th>
                        <th>تاریخ ایجاد </th>
                        <th>عملیات</th>
                    </tr>

                </thead>
                <tbody>

                    @foreach ($offerCodes as $item)
                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>

                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{$item->fee}} @if ($item->offerType == "percentable")
                                    درصد
                                @else

                                ریال

                                @endif
                            </td>
                            <td>
                                {{ $item->code }}
                            </td>
                            <td>
                                {{ \Morilog\Jalali\Jalalian::forge($item->created_at)}}
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{route('admin.odderCodes.edit', ['odderCode'=>$item->id])}}">ویرایش</a>
                                <a class="btn btn-danger" href="">حذف</a>                
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


    </div>
@endsection

 @extends('admin.layouts.admin')

 @section('title')
     index vendors
 @endsection


 @section('content')
     <!-- Content Row -->
     <div class="row">

         <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
             <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">


                 <h5 class="font-weight-bold mb-3 mb-md-0">لیست کاربران</h5>

             </div>

             @if (isset($success))
                 <div class="alert alert-success" role="alert">

                     {{ $success }}

                 </div>
             @endif


             <div class="table-responsive">
                 <table class="table table-bordered table-striped text-center">

                     <thead>
                         <tr>
                             <th>#</th>
                             <th>نام </th>
                             <th> شماره موبایل </th>
                             <th>
                                آخرین بازدید
                             </th>
                             <th> اسم فروشگاه /نقش کاربر</th>

                             <th>عملیات</th>
                         </tr>
                     </thead>
                     <tbody>

                         @foreach ($users as $user)
                             <a>

                                 <tr>

                                     <th>

                                     </th>
                                     <th>
                                        <a  href="{{ route('admin.showUserDetail', ['id' => $user->id]) }}" >
                                            {{ $user->name }}
                                        </a>
                                     </th>
                                     <th>
                                         {{ $user->mobile }}
                                     </th>
                                     <th>

                                     {{ $user->last_login ? \Morilog\Jalali\Jalalian::forge($user->last_login) : 'null' }}
                                     </th>
                                     <th>

                                         @if ($user->rols()->where('name', 'admin')->get()->count() == 0)
                                             @if ($user->vendor && $user->vendor->status != 'no')
                                                 <a href="{{ route('admin.vendors.show', ['vendor' => $user->vendor]) }}">

                                                     {{ $user->vendor->name }}

                                                     @if (is_null($user->boss_id))
                                                         (مدیر فروشگاه)
                                                     @else
                                                         (کارمند)
                                                     @endif


                                                 </a>
                                             @elseif($user->vendor && $user->vendor->status == 'no')
                                                 در انتظار تکمیل اطلاعات
                                                 {{ $user->vendor->name }}

                                                 (مدیر فروشگاه)
                                             @else
                                                 <span class="text-danger"> بدون فروشگاه
                                                 </span>
                                             @endif
                                         @else
                                             ادمین
                                         @endif
                                     </th>
                                     <th>

                                         {{-- <button type="button" class="btn btn-danger"
                                            onclick="$('.username').val({{ $user->name }});  " data-toggle="modal"
                                            data-target="#exampleModalLong">
                                            حذف
                                        </button> --}}

                                         @if ($user->rols()->where('name', 'admin')->get()->count() == 0)
                                             <a href="{{ route('admin.deleteUser', ['user' => $user->id]) }}"
                                                 class="btn btn-danger">حذف</a>
                                         @endif
                                         <button class="btn btn-primary">ویرایش</button>

                                     </th>


                                 </tr>
                             </a>
                         @endforeach
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

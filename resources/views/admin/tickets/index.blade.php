@extends('admin.layouts.admin')

@section('title')
    index brands
@endsection

<script>
    function deleteGroup() {
        var ids = [];

        $('input[name="ids[]"]:checked').each(function() {

            ids.push(this.value)
        });
        if (ids.length == 0) {
            window.alert("هیچ تیکتی انتخاب نشده")         
        }else{
            $('#TicketIDs').val(ids);
            if (window.confirm('ایا از حذف موارد انتخاب شده اطمینان دارید؟')) {
                $('#groupFormDelete').submit();
            }
        }

    }
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('checkAll');
        const TIds = document.querySelectorAll('.TIds');

        // Function to check all TIds
        function checkAllTIds() {
            TIds.forEach(TId => {
                TId.checked = true;
            });
        }

        // Function to uncheck all TIds
        function uncheckAllTIds() {
            TIds.forEach(TId => {
                TId.checked = false;
            });
        }

        // Function to check if all TIds are checked
        function areAllTIdsChecked() {
            return Array.from(TIds).every(TId => TId.checked);
        }

        // Event listener for "Check All" checkbox
        checkAll.addEventListener('change', function() {
            if (this.checked) {
                checkAllTIds();
            } else {
                uncheckAllTIds();
            }
        });

        // Event listener for individual TIds checkboxes
        TIds.forEach(TId => {
            TId.addEventListener('change', function() {
                if (!this.checked) {
                    checkAll.checked = false;
                } else if (areAllTIdsChecked()) {
                    checkAll.checked = true;
                }
            });
        });
    });

</script>
@section('content')
<div class="">
    @if (Session::has('success'))
    <div class="alert alert-info">
        {{ Session::get('success') }}
    </div>
    @endif
    @if (Session::has('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif
</div>
<!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست تیکت ها </h5>
            </div>

            <div class="">

                <span class="btn btn-danger"style="float:left;" id="showDeleteFormBt"
                    onclick="$('.TIds').css('display' , 'block'); $('#showDeleteFormBt').css('display' , 'none'); $('#groupFormDelete').css('display' , 'block'); ">
                    حذف گروهی </span>
            
            
                <form action="{{ route('admin.tickets.deleteByGroup') }}" style="display: none; float:left;"
                    id="groupFormDelete" method="post">
            
                    @csrf
            
                    <input value="حذف" onclick="deleteGroup()" class="btn btn-danger">
            
                <input type="hidden" name="TicketIDs" id="TicketIDs">
            
                    <span class="btn btn-success"style="float:left;"
                        onclick="$('.TIds').css('display' , 'none');  $('#showDeleteFormBt').css('display' , 'block'); $('#groupFormDelete').css('display' , 'none');">
                        لغو </span>
            
                </form>
            
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="checkAll" style="display:none;" class="TIds">
                                <label for="checkAll" style="display:none;" class="TIds">checkAll</label>
                            </th>
                            <th>نام فرستنده</th>
                            <th>شماره تلفن</th>
                            <th>ایمیل</th>
                            <th>عنوان تیکت</th>
                            <th>متن تیکت</th>
                            <th> وضعیت </th>
                            <th>
                                تاریخ ایجاد
                            </th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>


                                <th>

                                    
                                    <input type="checkbox" style="display:none;" name="ids[]"
                                        value="{{ $ticket->id }}" class="TIds">

                                        
                                    @if ($ticket->has_New_Ticket_In_This_Thread_from_user > 0)
                                        <p
                                            style="background-color: rgb(20, 229, 20); border-radius: 50%; width:15px; height: 15px; margin:10px; ">

                                            {{ $ticket->has_New_Ticket_In_This_Thread_from_user  }}
                                        </p>
                                    @endif


                                </th>

                                <th>

                                    @if ($ticket->username == 'guest')
                                        کاربر مهممان
                                    @elseif($ticket->vendor)

                                    <a     href="{{ route('vendor.home', ['vendor' => $ticket->vendor->name]) }}"
                                         
                                        > {{ $ticket->vendor->title }}</a>
                                    @else
                                        فروشگاه حذف شده
                                    @endif


                                </th>
                                <th>
                                    {{ $ticket->number }}
                                </th>
                                <th>
                                    {{ $ticket->email }}
                                </th>
                                <th>
                                    {{ $ticket->subject }}

                                </th>
                                <th>
                                    {{ substr($ticket->massage, 0, 100) . '... ' }}
                                </th>
                                <th>

                                    @if ($ticket->status == 'open')
                                        <span class="text-success">باز</span>
                                    @elseif($ticket->status == '1')
                                        بسته شده توسط کاربر
                                    @elseif($ticket->status == '2')
                                        بسته شده توسط ادمین
                                    @endif

                                </th>

                                <th>
                                         
                                    {{ \Morilog\Jalali\Jalalian::forge($ticket->created_at) }}
                                       
             
                                </th>
                                <th>
                                    <a href="{{ route('admin.tickets.show', ['id' => $ticket->id]) }}" class="btn btn-primary">
                                        مشاهده </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">

            </div>
        </div>
    </div>
@endsection

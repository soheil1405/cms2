@extends('user.layouts.user')
@section('title')
    لیست اعلانات
@endsection

@section('content')
    <div class="row">
        
        <div class="col-12">
            <div style="height: 1000px; overflow-y: hidden;" class="card">

                <div class="card-header">
                    <h3 class="card-title">لیست اعلانات</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0 shadow-lg p-3 mb-5 bg-white rounded " >
                    {{-- <table class="table table-hover"> --}}
                  <?php $massages = Auth::user()->vendor->AdminMassages;?>

                  @foreach( App\Models\MessageFromAdmin::all() as $msg)


                  <?php 

                    $msg->update([
                      'seen_at'=> Carbon\Carbon::now()
                    ]);

                    ?>

                  @endforeach


                        @foreach($massages as $msg)
                        <div  class="shadow-lg p-3 mb-5 bg-white rounded ">
                            {{$msg->message}}

                            <div class="" style="">
                                {{ \Morilog\Jalali\Jalalian::forge($msg->created_at) }}

                            </div>
                        </div>

                        @endforeach

                    </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('footer_scripts')
    <script>
        $(document).ready(function () {
            $( "#typeFilter" ).change(function() {
                console.log($('#filterForm'));
                $('#filterType').val(this.value);
                $('#filterForm').submit();
            });
        });
    </script>
@endpush
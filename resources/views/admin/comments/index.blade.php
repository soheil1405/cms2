@extends('admin.layouts.admin')

@section('title')
    index banner
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست دیدگاه ها ({{ count($AllComments) }})</h5>

                @if (count($new_comments) > 0)
                    <p> تعداد
                        <span class="text-danger">
                            {{ count($new_comments) }}
                        </span>
                        دیدگاه در انتظار تایید

                    </p>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان محصول</th>
                            <th>نوبسنده</th>
                            <th>ایمیل</th>
                            <th>شماره تلفن</th>

                            <th>متن دیدگاه</th>
                            <th>تاریخ ثبت</th>
                            <th>نوع کامنت</th>

                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($AllComments as $comment => $item)
                            <tr>

                                @if ($item->product)
                                    <th>
                                        {{ $item->id }}
                                    </th>

                                    <th>
                                        <a
                                            href="{{ route('products.show', [ 'product' => $item->product->slug]) }}">

                                            @if (!is_null($item->product_id) && !is_null($item->vendor_id))
                                                {{ $item->product->name }}
                                            @elseif(is_null($item->vendor->name))
                                                فروشگاه حذف شده
                                            @endif
                                        </a>
                                    </th>

                                    <th>
                                        {{ $item->username }}
                                    </th>



                                    @if ($item->email)
                                        <th>
                                            {{ Str::limit($item->email, 50) }}
                                        </th>
                                    @else
                                        <th>

                                        </th>
                                    @endif


                                    @if ($item->number)
                                        <th>
                                            {{ $item->number }}
                                        </th>
                                    @else
                                        <th>

                                        </th>
                                    @endif

                                    <th>
                                        {{ $item->comment }}
                                    </th>

                                    <th>
                                        {{ \Morilog\Jalali\Jalalian::forge($item->created_at) }}
                                    </th>

                                    <th>
                                        @if ($item->MainParent == null)
                                            کامنت اول
                                        @else
                                            در پاسخ به :

                                            {{-- {{$item->Parent->username}} --}}
                                        @endif
                                    </th>

                                    <th>
                                        @if ($item->is_active == '1')
                                            <span>تایید شده</span>
                                        @else
                                            <span class="text-danger">در انتظار تایید</span>
                                        @endif
                                    </th>


                                    <th>
                                        @if ($item->is_active == '1')
                                            <form action="{{ route('admin.comments.destroy') }}" method="post">
                                                @csrf
                                                <input type="hidden" name='id' value="{{ $item->id }}">

                                                <button type="submit" class=" p-1 btn btn-sm btn-outline-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                            </form>


                                            <a data-toggle="modal" onclick="showComment({{ $item }})"
                                                data-target="#exampleModal" href="#">

                                                پاسخ

                                            </a>
                                            {{-- <button type="button" class="btn btn-primary"  data-toggle="modal"
                                    data-target="#exampleModal" >
                                </button> --}}

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                <form action="{{ route('AnswerComment') }}" method="post">

                                                    @csrf


                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">پاسخ به
                                                                    دیدگاه</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">





                                                                <div id="modalCommentWriter">

                                                                </div>

                                                                <hr>


                                                                <input type="hidden" id="answered_to" name="answered_to">

                                                                <input type="hidden" name="username"
                                                                    value="{{ Auth::user()->name }}">

                                                                <div class="modalCommentText">



                                                                    <input type="text" required
                                                                        placeholder="پاسخ خود را اینحا وارد کنید"
                                                                        name="comment" class="form-control" id="">



                                                                </div>

                                                                <div class="form-group mt-4 mb-4">
                                                                    <div class="captcha">
                                                                        <span>{!! Captcha::img('flat') !!}</span>
                                                                        <button type="button" class="btn btn-danger"
                                                                            class="reload" onclick="reloadCaptcha()">
                                                                            &#x21bb;
                                                                        </button>
                                                                    </div>
                                                                </div>




                                                                <div class="col-12">
                                                                    <div class="form-group">

                                                                        <input type="text" name="captcha" required
                                                                            placeholder="مقدار بالا را اینجا وارد کنید"
                                                                            class="form-control required">
                                                                        @error('captcha')
                                                                            <p class="text-danger"> فیلد فرم اعتبار سنجی به
                                                                                درستی وارد
                                                                                نشده است </p>
                                                                        @enderror
                                                                    </div>
                                                                </div>







                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">لغو</button>
                                                                <button type="submit" class="btn btn-primary">ارسال
                                                                    پاسخ</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @else
                                            <div style="display: flex; justify-content: center;" class="">

                                                <form action="{{ route('admin.comments.destroy') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name='id' value="{{ $item->id }}">

                                                    <button type="submit" class=" p-1 btn btn-sm btn-outline-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-trash3-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                        </svg>
                                                    </button>
                                                </form>

                                                <form id="acceptProductRequest"
                                                    action="{{ route('admin.comments.acceptComment') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success"
                                                        style="margin: 0 !important;" for="id"> تایید دیدگاه
                                                    </button>
                                                    <input type="hidden" value="{{ $item->id }}"name="id">
                                                </form>
                                            </div>
                                        @endif
                                    </th>

                            </tr>
                        @elseif($item->vendor)
                            <tr>
                                <th>
                                    {{ $item->id }}
                                </th>

                                <th>
                                    <a href="{{ route('vendor.home', ['vendor' => $item->vendor->name]) }}">
                                        {{ $item->vendor->name }}

                                    </a>
                                </th>

                                <th>
                                    {{ $item->username }}
                                </th>











                                @if ($item->email)
                                    <th>
                                        {{ $item->email }}
                                    </th>
                                @else
                                    <th>

                                    </th>
                                @endif


                                @if ($item->number)
                                    <th>
                                        {{ $item->number }}
                                    </th>
                                @else
                                    <th>

                                    </th>
                                @endif









                                <th>
                                    {{ $item->comment }}
                                </th>

                                <th>
                                    {{ \Morilog\Jalali\Jalalian::forge($item->created_at) }}
                                </th>

                                <th>
                                    @if ($item->MainParent == null)
                                        کامنت اول
                                    @else
                                        در پاسخ به :

                                        {{-- {{$item->Parent->username}} --}}
                                    @endif
                                </th>

                                <th>
                                    @if ($item->is_active == '1')
                                        <span>تایید شده</span>
                                    @else
                                        <span class="text-danger">در انتظار تایید</span>
                                    @endif
                                </th>


                                <th>
                                    @if ($item->is_active == '1')
                                        <form action="{{ route('admin.comments.destroy') }}" method="post">
                                            @csrf
                                            <input type="hidden" name='id' value="{{ $item->id }}">

                                            <button type="submit" class=" p-1 btn btn-sm btn-outline-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <div style="display: flex; justify-content: center;" class="">

                                            <form action="{{ route('admin.comments.destroy') }}" method="post">
                                                @csrf
                                                <input type="hidden" name='id' value="{{ $item->id }}">

                                                <button type="submit" class=" p-1 btn btn-sm btn-outline-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash3-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <form id="acceptProductRequest"
                                                action="{{ route('admin.comments.acceptComment') }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success"
                                                    style="margin: 0 !important;" for="id"> تایید دیدگاه
                                                </button>
                                                <input type="hidden" value="{{ $item->id }}"name="id">
                                            </form>
                                        </div>
                                    @endif
                                </th>

                            </tr>
                        @endif
                        @endforeach


                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection


<script>
    function showComment(item) {
        reloadCaptcha();
        // console.log('asdasasd');
        console.log(item);



        $('#answered_to').val(item.id)


        $('#modalCommentWriter').html(item.username + " : " + item.comment);

        $('#modalCommentText').html(item);
    }





    function reloadCaptcha() {
        console.log('asdasd');
        $.ajax({
            type: 'POST',
            url: '/reloadCaptch',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $(".captcha span").html(data.captcha);
            },
            error: function(data) {
                console.log(dara);
            }
        });
    }
</script>

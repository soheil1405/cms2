@extends('user.layouts.user')

@section('title')
    index banner
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        @if (Session::has('created'))
            <div class="alert alert-success">
                {{ Session::get('created') }}
            </div>
        @endif
        <div class="col-xl-12 col-md-12 ">
            <div
                class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4 bg-white py-4 px-2 rounded">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست دیدگاه ها ({{ count($articles) }})</h5>
                <a class="btn btn-primary" href="{{ route('user.UserArticles.create') }}">افزودن مقاله</a>
            </div>

            <div class="alert alert-success">
                به ازای هر سه مقاله ۱ استوری رایگان هدیه بگیرید &#128512;

            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان مقاله</th>
                            <th>نویسنده</th>
                            <th>تاریخ ثبت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($articles as $item)
                            <tr>

                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>

                                <td>
                                    {{ $item->user->name }}
                                </td>
                                <td>
                                    {{ \Morilog\Jalali\Jalalian::forge($item->created_at) }}
                                </td>
                                <td>
                                    @if ($item->status == '1')
                                        منتشر شده
                                    @else
                                        در انتظار تایید
                                    @endif
                                </td>

                                <td>




                                    <form onSubmit="return confirm('ایا از حذف این مقاله اطمینان دارید؟') "
                                        action="{{ route('user.UserArticles.destroy', ['UserArticle' => $item]) }}"
                                        method="post">

                                        @method('DELETE')

                                        @csrf

                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="submit" value="حذف" class="btn btn-danger">

                                        <a href="{{ route('user.UserArticles.edit', ['UserArticle' => $item]) }}"
                                            class="btn btn-info">ویرایش </a>

                                    </form>


                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection

<script>
    function showComment(item) {

        console.log('asdasasd');
        console.log(item);

        $('#modalCommentWriter').html(item);

        $('#modalCommentText').html(item);
    }
</script>

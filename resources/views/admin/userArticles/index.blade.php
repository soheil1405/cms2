@extends('admin.layouts.admin')

@section('title')
    مقالات کاربران
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        @if (Session::has('ok'))
            <div class="alert alert-success">
                {{ Session::get('ok') }}
            </div>
        @endif
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">

                <h1>
                    مقالات کاربران
                </h1>
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
                        @if ($item->user)
                            
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
                                    @elseif($item->status == '2')
                                        ویرایش شده
                                    @elseif($item->status == '3')
                                        ریپورت شده
                                    @else
                                        در انتظار تایید
                                    @endif
                                </td>

                                <td>

                                    @if ($item->status != '1')
                                        <form action="{{ route('admin.acceptUserArticle') }}" method="post">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input class="btn btn-success" type="submit" value="تایید مقاله">


                                        </form>
                                    @endif

                                    {{-- <a href="{{}}">ریپورت</a> --}}

                                    <a href="{{ route('admin.UserArticles.edit', ['UserArticle' => $item]) }}"
                                        class="btn btn-info">ویرایش </a>

                                    <form onSubmit="return confirm('ایا از حذف این مقاله اطمینان دارید؟') "
                                        action="{{ route('admin.UserArticles.destroy', ['UserArticle' => $item]) }}"
                                        method="post">

                                        @method('DELETE')

                                        @csrf

                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="submit" value="حذف" class="btn btn-danger">



                                    </form>

                                </td>
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

        console.log('asdasasd');
        console.log(item);

        $('#modalCommentWriter').html(item);

        $('#modalCommentText').html(item);
    }
</script>

@extends('admin.layouts.admin')

@section('title')
    مقالا ادمین
@endsection

@section('content')


    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست مقاله ها</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.articles.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد مقاله جدید
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th> عکس اصلی </th>
                            <th> عنوان مقاله </th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($articles as $article)
                            <tr>
                                <th>
                                    {{ $article->id }}
                                </th>
                                <th>
                                    <img src="{{ asset(env('ARTICLE_IMAGES_UPLOAD_PATH') . $article->main_img) }}"
                                        style="width: 80px; height:80px; " alt="">

                                </th>
                                <th>
                                    {{ $article->title }}
                                </th>
                                <th>
                                    {{ \Morilog\Jalali\Jalalian::forge($article->created_at) }}

                                </th>


                                <th>
                                    <form action="{{ route('admin.articles.destroy' , ['article'=>$article]) }}" method="post">
                                        @csrf

                                        @method("DELETE")
                                        <input type="hidden" name='id' value="">
                                        <button type="submit" class=" p-1 btn btn-sm btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </button>


                                        <a href="{{ route('admin.articles.edit', ['article' => $article]) }}"
                                            class="btn btn-sm btn-primary">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                        </a>


                                        <a href="{{ route('admin.articles.show', ['article' => $article]) }}"
                                            class=" btn btn-sm btn-outline-primary"> نمایش </a>


                                    </form>





                                </th>



                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection

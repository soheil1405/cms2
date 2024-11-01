@extends('admin.layouts.admin')

@section('title')
    index categories
@endsection

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        آیا از حذف دسته ی
                        (<span id="CatDeleteName"></span>)

                        اطمینان دارید؟

                    </h5>

                </div>

                <form action="{{ route('admin.categoriesDestroy') }}" method="post">
                    @csrf
                    <div class="modal-body">


                        <input type="hidden" name="id" id="catDeleteid">

                        <label for="">دسته ای را برای انتفال محصولات انتخاب کنید</label>
                        <select name="cat_id" data-live-search="true" id="brandSelect" required>

                            @foreach ($moreCats as $cat)
                                <option value="{{ $cat->id }}" class="form-control">{{ $cat->name }}
                                </option>
                            @endforeach
                        </select>



                        <input type="submit" class="btn btn-danger" value="حذف">
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        افزودن زیر دسته جدید برای (<span id="newParName"></span>
                        )
                    </h5>

                </div>

                <form action="{{ route('admin.categories.store') }}" method="post">
                    @csrf
                    <div class="modal-body">


                        <input type="hidden" name="parent_id" id="newParId">


                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" required
                            value="{{ old('name') }}">

                        <input type="submit" class="btn btn-primary" value="ذخیره دسته بندی">
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>

                </form>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست دسته بندی ها ({{ $categories->total() }})</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد دسته بندی
                </a>
            </div>

            @if (Request()->has('search'))
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>والد</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <th>
                                        {{ $categories->firstItem() + $key }}
                                    </th>
                                    <th>
                                        {{ $category->name }}
                                    </th>
                                    <th>
                                        @if ($category->parent_id == 0)
                                            بدون والد
                                        @else
                                            {{ $category->parent->name }}
                                        @endif
                                    </th>

                                    <th>
                                        <span
                                            class="{{ $category->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                            {{ $category->is_active }}
                                        </span>
                                    </th>
                                    <th>
                                        <a class="btn btn-sm btn-outline-success " style="margin: 0 15px 5px 0;"
                                            href="{{ route('categories.show', ['category' => $category->slug]) }}">نمایش</a>
                                        <a class="btn btn-sm btn-outline-info mr-3 "
                                            href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">ویرایش</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="accordion" id="accordionExample">


                    @foreach ($parentCats as $parentCat)
                        <ul style="border:1px solid black; ">
                            <strong style="color:black;">
                                {{ $parentCat->name }} ({{ count($parentCat->childrens) }})

                                <a class="btn btn-sm btn-outline-success " style="margin: 0 15px 5px 0;"
                                    href="{{ route('categories.show', ['category' => $parentCat->slug]) }}">نمایش</a>
                                <a class="btn btn-sm btn-outline-info mr-3 "
                                    href="{{ route('admin.categories.edit', ['category' => $parentCat->id]) }}">ویرایش</a>
                                |
                                <!-- Button trigger modal -->
                                <a href="#" type="button" class="" data-toggle="modal"
                                    data-target="#exampleModal" onclick="addSubCat({{ $parentCat }})">
                                    افزودن زیر دسته جدید
                                </a>

                                |
                                <a href="#" data-toggle="modal" data-target="#DeleteModal"
                                    onclick="DeleteCat({{ $parentCat }})" class="text-danger">حذف</a>

                            </strong>

                            @foreach ($parentCat->childrens as $firstChild)
                                <ul>
                                    {{-- @if (count($firstChild->childrens) == 0)
                                        <li style="list-style-type: none; margin-right:20px;">
                                            {{ $firstChild->name }} ({{ count($firstChild->childrens) }})

                                            <a class="" style="margin: 0 15px 5px 0;"
                                                href="{{ route('categories.show', ['category' => $firstChild->slug]) }}">نمایش</a>
                                            |<a class=" "
                                                href="{{ route('admin.categories.edit', ['category' => $firstChild->id]) }}">ویرایش</a>
                                        </li>
                                    @else --}}
                                    <div class="accordion-item">


                                        <div class="d-flex">

                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse_{{ $firstChild->id }}" aria-expanded="true"
                                                    aria-controls="collapseOne">

                                                    {{ $firstChild->name }} ({{ count($firstChild->childrens) }})
                                                </button>







                                            </h2>
                                            |
                                            <a
                                                href="{{ route('categories.show', ['category' => $firstChild->slug]) }}">نمایش</a>|
                                            <a class=" "
                                                href="{{ route('admin.categories.edit', ['category' => $firstChild->id]) }}">ویرایش</a>
                                            |
                                            <!-- Button trigger modal -->
                                            <a href="#" style="color: black;" type="button" class=""
                                                data-toggle="modal" data-target="#exampleModal"
                                                onclick="addSubCat({{ $firstChild }})">
                                                افزودن زیر دسته جدید
                                            </a>
                                            |

                                            |
                                            <a href="#" data-toggle="modal" data-target="#DeleteModal"
                                                onclick="DeleteCat({{ $firstChild }})" class="text-danger">حذف</a>
                                        </div>
                                        <div id="collapse_{{ $firstChild->id }}" class="accordion-collapse collapse "
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">

                                                @foreach ($firstChild->childrens as $secondChild)
                                                    <li>
                                                        {{ $secondChild->name }}


                                                        <a class=" "
                                                            href="{{ route('categories.show', ['category' => $secondChild->slug]) }}">نمایش</a>

                                                        | <a class=" "
                                                            href="{{ route('admin.categories.edit', ['category' => $secondChild->id]) }}">ویرایش</a>


                                                        |

                                                        |
                                                        <a href="#" data-toggle="modal" data-target="#DeleteModal"
                                                            onclick="DeleteCat({{ $secondChild }})"
                                                            class="text-danger">حذف</a>

                                                    </li>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endif --}}
                                </ul>
                            @endforeach

                        </ul>
                    @endforeach




                </div>
            @endif
            <div class="d-flex justify-content-center mt-5">
                {{ $categories->render() }}
            </div>
        </div>

    </div>
@endsection


<script>
    function addSubCat(item) {


        console.log(item);


        $('#newParName').html(item.name);

        $('#newParId').val(item.id);


    }


    function DeleteCat(item) {


        console.log(item);


        $('#CatDeleteName').html(item.name);

        $('#catDeleteid').val(item.id);


    }
</script>

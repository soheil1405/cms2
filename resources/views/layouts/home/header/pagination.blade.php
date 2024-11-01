<nav aria-label="Page navigation " class=" justify-content-center ">
                <ul class="pagination justify-content-center" style=" ">

                    {{-- it will be show , if currect page was not 1 --}}
                    @if ($item->previousPageUrl())
                        <li class=""><a class="page-link "

                            href="{{ $item->previousPageUrl() }}">قبلی</a>
                        </li>
                    @endif

                    {{-- cuurect page --}}

                    <li class=""><a class="page-link "
                            style="  margin-right:2%; border:1px solid gray"href="">{{ $item->currentPage() }}</a>
                    </li>

                    {{-- it will be show , if currect page was not the last one --}}
                    @if ($item->currentPage() != $item->lastPage())
                        <li class=""><a class="  page-link"
                                style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"
                                href="{{ $item->nextPageUrl() }}">بعدی</a>
                        </li>
                    @endif



                </ul>
            </nav>
       
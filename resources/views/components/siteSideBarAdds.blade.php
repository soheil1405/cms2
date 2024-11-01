<div class="d-none d-md-block    ">

    @if (count($sideAddLinks) > 0)
        <div class="bg-white border-15 ">
            <div class="" style="height:100vh;">
                @foreach ($sideAddLinks as $link)
                   <div class="pb-1"  style="height:20% !important;width:100%;">
                    <a  href="{{ $link->link }}">
                        <img class="  rounded " style="height: 100%;width:100%;object-fit:cover;"
                            src="{{ asset(env('SIDEBAR_LINKS_PIC_PATH') . $link->image) }}" alt="">
                    </a>
                   </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@php

    $settings = App\Models\Admin\Setting::first();

    $siteSettings = App\Models\Admin\SiteSetting::first();
@endphp


@if ($siteSettings->subtitle_status)
    <section style="overflow-x: hidden;direction:ltr;text-align:left;" class="bg-subtitle">
        <div style=" 
        flex-wrap: nowrap;
        white-space: nowrap;
        flex-direction: row-reverse;
    
    " >
            <section class="news-message ">
             
                <p class="text-newstext text-white m-0 w-100">
                    {{ $settings->subtitle }}

                </p>

            </section>

        </div>
    </section>




    {{-- <div style=" background-color: gray; padding:5px; color:white;z-index:65555">

    </div> --}}
@endif

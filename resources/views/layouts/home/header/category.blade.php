


@if (!isset($category) && !isset($vendor) && !request('btnradioSearch') && !isset($articles) && !isset($more_articles))



<nav  class=" bigCatMenu   border-0 menu-navbar m-0 mt-2">
    <input type="checkbox" class="toggler">

    @foreach (\App\Models\Category::lvl_one()->orderBy('id')->get() as $key => $category)
        <div  class="menu-dropdown" tabindex="0">

            @if ($category->childrens()->count() == 0)
                <div class="dropbtn">
                    <a href="#" onclick="return false;">
                        <img class="" src="{{ url(env('CATEGORY_ICON_UPLOAD_PATH') . $category->icon) }}">
                        <span class="text-center">
                            {{ $category->name }}
                            <i class="fa fa-caret-down"></i>
                        </span>
                    </a>
                </div>
            @else
                <div  class="dropbtn"  >
                    <a href="{{ route('categories.show', ['category' => $category->slug]) }}">
                        <img class="" src="{{ url(env('CATEGORY_ICON_UPLOAD_PATH') . $category->icon) }}">
                        <span class="text-center">
                            {{ $category->name }}
                            <i class="fa fa-caret-down"></i>
                        </span>
                    </a>
                </div>

                <div onmouseover="      $(this).prev().addClass('activeCat')"; onmouseout="$(this).prev().removeClass('activeCat');"  style="min-height:10px !important;  "   class="dropdown-content" tabindex="0">
                    
                    

                                    <div   style="display: flex; justify-content: center;  border:1px solid red; border-radius: 10px; " class="">
                                    @foreach ($category->childrens as $lvl_two)



                                    
                                        <div style="    display: flex; flex-direction:column; " class="">
                                            <div onmouseover="showChild({{$lvl_two->id}})" class="category-item"
                                                style="display: flex; !important; ">
                                                
                                                <a class="category-title"
                                                    href="{{ route('categories.show', ['category' => $lvl_two->slug]) }}"
                                                    style=  "  border-bottom: 1px solid #aaa7a7;  width:100%; height:100%; color:black; display: flex !important;">
                                                     
                                                <strong class="vazirFont">  {{ $lvl_two->name }} </strong>  </a>
                                            </div>
                                        
                                            <div  class="">
                                                @foreach ($lvl_two->childrens as $lvl_three)

                                                <div id="third_child({{$lvl_two->id}})"  class="category-item third_child_div" tabindex="0"
                                                style=" padding:0 !important; margin:0 !important; display:flex ; flex-direction: column ; ">
                                                <a class="category-title"
                                                    href="{{ route('categories.show', ['category' => $lvl_three->slug]) }}"
                                                    style="  padding:5px 5px !important; margin:0 !important; 
                                                    color:black; text-align: right; display: flex !important; ">
                                                    {{ $lvl_three->name }}
                                                </a>
                                            </div>
                                                
                                                @endforeach
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                            </div>


            @endif

        </div>
    @endforeach


    <div class="menu-dropdown" tabindex="0">

    </div>



</nav>

@endif


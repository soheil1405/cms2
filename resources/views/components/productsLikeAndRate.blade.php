


@auth
<small  
 class="dissliked addToFAvorite_{{ $product->id }}"  title="افزودن به علاقه مندی"
        onclick="addToFAvorite('p' , {{ $product->id }} ) "
        @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product->id)->get()) >= 1) style="display:none" @endif>
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
            fill="currentColor" style="color: #000;" class="bi bi-heart" viewBox="0 0 16 16">
            <path
                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
        </svg>

</small>

    <small 
    
    @if (count(App\Models\favorite::where('vendor_id', Auth::user()->vendor->id)->where('product_id', $product->id)->get()) < 1) style="display:none" @endif 

    class="liked removeFromFavorite{{ $product->id }}"
         onclick="removeFromFavorite('p',{{ $product->id }})"
        title="حذف از علاقه مندی ها">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red"
            class="bi bi-heart-fill" style="color: #000;" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
        </svg>
    </small>



@endauth

@guest

    <?php
        $counter = null;
        
        if (Session::has('favorite_p')) {
            $Pfavorited = Session::get('favorite_p');
        
            foreach ($Pfavorited as $item) {
                if ($item['id'] == $product->id) {
                    $counter = true;
                }
            }
        }
        
    ?>

    <small
    
        @if ($counter) style="display:block;" @else style="display:none;" @endif
        
        
        
        class="liked removeFromFavorite{{ $product->id }}" title="حذف از علاقه مندی ها"
            onclick="removeFromFavorite('p',{{ $product->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                fill="red" class="bi bi-heart-fill Seticonsingleproduct"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
            </svg>
    </small>
    
    <small title="افزودن به علاقه مندی ها" 
        @if ($counter) style="display:none;"@else style="display:block;" @endif

        class="dissliked addToFAvorite_{{$product->id}}"


            onclick="addToFAvorite('p' , {{$product->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                fill="currentColor" style="color: #000;"
                class="bi bi-heart Seticonsingleproduct" viewBox="0 0 16 16">
                <path
                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
            </svg>

    </small>
    
@endguest
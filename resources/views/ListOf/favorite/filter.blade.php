




<style>

@media (max-width: 750.98px) {
        
        .filterBoxfavorite{
            display: none;
        }

        .filterbt{
            display: block !important;
        }


    }
</style>








<div class="col-12 bg-white " >
    <div class="offcanvas offcanvas-end" style="--bs-offcanvas-zindex:2000;--bs-offcanvas-width:90%;" tabindex="-1"
        id="filterNAv" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                فیلترها
            </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
       
        <div class=" col-md-2 col-sm-12 bg-white  ">


            <a href="{{ route('favorite.vendors') }}" class="  filterr  ">


                <h4> <strong>

                        فروشگاه ها

                    </strong>

                    (
                    {{ count($vendors) }}
                    )

                </h4>

            </a>


            <hr>
            <a href="{{ route('favorite.products') }}" class=" filterr">


                <h4> <strong>


                        محصولات

                    </strong>






                    (
                    {{ count($products) }}
                    )
                </h4>
            </a>
            <hr>

            <a href="{{ route('favorite.articles') }}" class="  filterr ">

                <h4> <strong>

                        مقاله ها

                    </strong>

                    (

                    {{ count($articles) }}

                    )

                </h4>
            </a>

            


        </div>
    </div>

</div>

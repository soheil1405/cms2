@extends('vendors.layouts.single')
<meta name="viewport" content="width=device-width, initial-scale=1">

@section('title')
    محصولات فروشگاه | {{ $vendor->name }}
@endsection

@push('header_styles')
    @include('layouts.home.header.styles')
    
@endpush

@section('ngApp',env('APP_NAME'))

@section('ngController','products')

@push('top_scripts')
  
  
  
  
  
@endpush


@push('header_scripts')
    @include('layouts.home.header.scripts')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
@endpush


@push('headers')
    @include('layouts.home.header.head')
@endpush

@push('bodyClass','bg-body')

@push('contents')

    <div class="container">

        <div class="row pt-4">
            <div class="col-12">
                <div class="shadow p-3 rounded-pill">
                    <h2 class="text-center">
                        محصولات فروشگاه {{ $vendor->title }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="row pt-4">

            
            <div class="col-12 col-md-9">
                <div class="row">
                    @include('layouts.products', ['item' => $products, 'type' => 'product'])
                </div>
            </div>
        </div>

        
        {{--  <a class="btn btn-secondary" href="{{route('vendor.home' , ['vendor'=>$vendor])}}">بازگشت</a>  --}}


        {{$products->links()}}
    </div>

@endpush

@push('footer_scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.js" integrity="sha512-T5Bneq9hePRO8JR0S/0lQ7gdW+ceLThvC80UjwkMRz+8q+4DARVZ4dqKoyENC7FcYresjfJ6ubaOgIE35irf4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>

    jQuery.fn.tagName = function () {
        return this.prop("tagName");
    };

    jQuery.fn.getSafeAttr = function (attr_name, default_var) {
        var var_elm = this.attr(attr_name);
        return (typeof var_elm !== 'undefined' && var_elm !== false) ? var_elm : default_var;
    };
    var app = angular.module("{{ env('APP_NAME') }}", []);
    app.directive('customRangeSlider', function() {
        return {
            priority: 10, // adjust this value ;)
            require: 'ngModel',
            link: function(scope, element, attrs, ngModel) {
                if (!ngModel) return;
                scope.$watch(attrs.ngBind, function(newvalue) {
                    var elm_min = $(element).getSafeAttr("data-min", 0);
                    var elm_max = $(element).getSafeAttr("data-max", 100);

                    var elm_step = $(element).getSafeAttr("data-step", 1);

                    var elm_start = $(element).getSafeAttr("data-start", 0);
                    var elm_end = $(element).getSafeAttr("data-end", 1);

                    var elm_decimal_number = $(element).getSafeAttr("data-decimal-number", 0);

                    var selector_target_elm_min = $(element).attr("data-target-min");
                    var selector_target_elm_max = $(element).attr("data-target-max");


                    var slider = noUiSlider.create(element.get(0), {
                        start: [
                            parseInt(elm_start),
                            parseInt(elm_end)
                        ],
                        connect: true,
                        behaviour: 'drag-tap',
                        tooltips: [true, true],
                        step: parseFloat(elm_step),
                        
                        range: {
                            'min': parseInt(elm_min),
                            'max': parseInt(elm_max)
                        }
                    });
                    slider.on('update', function(values, handle) {


                        ngModel.$setViewValue(values);


                    });
                    ngModel.$render = function() {
                        //choices.setValue([]);
                        //choices.setValue(ngModel.$viewValue);
                    }
                });
            }
        };

    });

    app.controller("products", function ($scope) {

        $scope.price = {{request()->has('price')? 'true':'false'}};
        $scope.priceB = {'value':[{{(request()->has('price') && is_array(request()->price) && count(request()->price) == 2)? (request()->price[0].','.request()->price[1]):'1000,25000000'}}]};
        $scope.category = {{request()->has('category')? 'true':'false'}};


        $scope.fsortPrice = {'value':'{{ request()->has('sortPrice') ? request()->sortPrice:'no'}}'};
        $scope.fcategory = {'value':'{{ request()->has('category') ? request()->category:'default'}}'};

        $('#formFilter').on('submit',function(event){
            event.preventDefault();
            let currentUrl = '{{ url()->current() }}';
            let url = currentUrl + '?' + decodeURIComponent($(this).serialize());
            $(location).attr('href',url);
        });
        $scope.submit = function()
        {
            $('#formFilter').submit();
        }

        //$scope.$watch('')

    });
</script>


@endpush

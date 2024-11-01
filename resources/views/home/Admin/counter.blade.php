



<style>



    @media only screen and (max-width: 767px) {
    
    
        /* .homecounter{
            display: flex !important;
            flex-direction: column !important;
            
        } */
        .counterHome{
            font-size: 15px !important;
        }
    
        
    
    
    
    
    }
    
    
    
    </style>
    
    
    
    
    
    
    
    <div style="margin-top:40px !important; " class="row homecounter instarang brd25">
        <div class= " counterHome col-3">
            <h6 >{{ $Vendors_count }}</h6>
            <h5>فروشگاه ها</h5>
        </div>
        <div class=" counterHome col-3">
            <h6>{{ $Products_count }}</h6>
            <h5>کالا ها</h5>
        </div>
        <div class=" counterHome col-3">
            <h6>{{$Articles_count}}</h6>
            <h5>مقالات</h5>
        </div>
        <div class=" counterHome col-3">
            <h6>100</h6>
            <h5>بازدید ها</h5>
        </div>
    
    </div>
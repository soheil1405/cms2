{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> --}}





<style>
    .aactive {
        background-color: rgb(252, 138, 138);
    }

    .aactive .navclass {
        color: black !important;

    }

    .link:hover {
        background-color: rgb(245, 94, 94);

    }

    .paaa {
        border-radius: 50%;
        margin: 5px;
    }

    .card2 {
        height: 50px;
        position: relative;
        box-shadow: none;
        /* display: flex; */
        /* justify-content: space-between; */
        margin: 10px;
        border-radius: 5px;
        background-color: #fff;
        text-align: right !important;

        transition: all .5s;
    }

    .card-img-container {
        background: url(https://picsum.photos/300/300) center center no-repeat;
        background-size: cover;
        height: 200px;
        width: auto;
        border-radius: 5px 5px 0 0;
        filter: contrast(2) invert(0.2) sepia(0.7);
        transition: .4s all;
    }

    .card:hover .card-img-container {
        filter: none;
    }

    .card-text-container {
        padding: 20px;
        overflow: hidden;
    }

    .card-text-container.expanded {
        height: 500px;
    }

    .card-text-container h2,
    .card-text-container p {
        color: #13505c;
    }





    .card-link-container {
        height: 50px;
        position: absolute;
        bottom: 0;
        padding: 10px 20px 10px 20px;
    }

    .card-link-container a {
        color: #892f23;
        font-size: 18px;
        font-weight: bold;
    }

    .more-link:hover {
        cursor: pointer;
    }

    .filter-btn-row {
        text-align: center;
        margin-bottom: 30px;
    }

    .filter-btn {
        margin: 5px;
        width: 100px;
        font-size: 18px;
    }

    .selected {

        color: #fff;
        box-shadow: none;

    }



    .products li {
        padding: 7px;
        background-color: #fff;
    }

    .products .active a {
        color: black !important;
    }



    .vendors .active {

        scale: 1.6;

        padding 30px;

        top: 10px;

        padding: 10px !important;

        border-radius: 50% !important;

        box-shadow: 2px 2px 9px 2px #6c6969b5 !important;


    }

    .active {}

    .card-location {
        display: none;
        font-weight: bold;
    }


    .tabli {
        background-color: #cec9c9;
        border-radius: 5px 5px 0px 0px;
    }

    @media screen and (min-width: 0) and (max-width: 425px) {
        .filtered-cards {
            padding: 0;
        }

        .card {
            margin: 0px;
            margin-top: 20px;
            border-radius: 5px;

            text-align: left;

        }

        .filter-btn {
            width: 100px;
            font-size: 18px;
            margin: 10px;
        }
    }

    /** Remove img filter on mobile **/
    @media screen and (min-width: 0) and (max-width: 768px) {
        .card-img-container {
            filter: none;
        }

        .pagination {
            display: flex;
            justify-content: center;
        }

    }


    /* .card:hover {
            box-shadow: 2px 3px 12px 0px rgba(248, 70, 70, 0.75);

        } */


    .sampleFont {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
    }


    .vazirFont {
        font-family: "vazir" !important;
    }


    .activeTabb1 {

        scale: 1.4;
        color: #ffff !important;
        /* background-color: #fee0ec !important; */
        background-image: radial-gradient(circle at 13% 62%, hsla(191, 0%, 94%, 0.1) 0%, hsla(191, 0%, 94%, 0.1) 72%, transparent 72%, transparent 80%, transparent 80%, transparent 100%), radial-gradient(circle at 46% 87%, hsla(191, 0%, 94%, 0.1) 0%, hsla(191, 0%, 94%, 0.1) 29%, transparent 29%, transparent 76%, transparent 76%, transparent 100%), radial-gradient(circle at 46% 32%, hsla(191, 0%, 94%, 0.1) 0%, hsla(191, 0%, 94%, 0.1) 34%, transparent 34%, transparent 75%, transparent 75%, transparent 100%), radial-gradient(circle at 3% 53%, hsla(191, 0%, 94%, 0.1) 0%, hsla(191, 0%, 94%, 0.1) 11%, transparent 11%, transparent 57%, transparent 57%, transparent 100%), radial-gradient(circle at 53% 54%, hsla(191, 0%, 94%, 0.1) 0%, hsla(191, 0%, 94%, 0.1) 9%, transparent 9%, transparent 27%, transparent 27%, transparent 100%), linear-gradient(57deg, rgb(224, 200, 224), rgb(212, 98, 186));

        border: none !important;

        /* border-bottom: 6px solid #fee0ec !important; */
        padding-bottom: 0px !important;
        /* border-radius: 50% !important; */
        animation: shape 2s linear infinite;


    }

    .products .active {

        top: 10px;
        padding: 10px !important;

        text-align: center;
        border-bottum: NONE;
    }
    


    .activeTabb2 {

        color: #ffff !important;

        border: none !important;
        background-image: linear-gradient(482deg, rgba(94, 94, 94, 0.04) 0%, rgba(94, 94, 94, 0.04) 48%,rgba(220, 220, 220, 0.04) 48%, rgba(220, 220, 220, 0.04) 100%),linear-gradient(444deg, rgba(232, 232, 232, 0.04) 0%, rgba(232, 232, 232, 0.04) 9%,rgba(135, 135, 135, 0.04) 9%, rgba(135, 135, 135, 0.04) 100%),linear-gradient(200deg, rgba(26, 26, 26, 0.04) 0%, rgba(26, 26, 26, 0.04) 47%,rgba(147, 147, 147, 0.04) 47%, rgba(147, 147, 147, 0.04) 100%),linear-gradient(382deg, rgba(235, 235, 235, 0.04) 0%, rgba(235, 235, 235, 0.04) 68%,rgba(140, 140, 140, 0.04) 68%, rgba(140, 140, 140, 0.04) 100%),linear-gradient(266deg, rgb(244, 71, 207),rgb(243, 198, 242));

        /* border-bottom: 6px solid #ff5d99 !important; */
        /* background-color: #ff5d99 !important; */
        padding-bottom: 0px !important;
        scale: 1.4;
        /* border-radius: 50% !important; */
        animation: shape 2s linear infinite;



    }

    .activeTabb3 {
        color: #ffff !important;

        border: none !important;
        background-image: linear-gradient(257deg, rgba(246, 246, 246, 0.03) 0%, rgba(246, 246, 246, 0.03) 4%,rgba(152, 152, 152, 0.03) 4%, rgba(152, 152, 152, 0.03) 32%,rgba(123, 123, 123, 0.03) 32%, rgba(123, 123, 123, 0.03) 41%,rgba(189, 189, 189, 0.03) 41%, rgba(189, 189, 189, 0.03) 45%,rgba(151, 151, 151, 0.03) 45%, rgba(151, 151, 151, 0.03) 47%,rgba(61, 61, 61, 0.03) 47%, rgba(61, 61, 61, 0.03) 77%,rgba(34, 34, 34, 0.03) 77%, rgba(34, 34, 34, 0.03) 100%),linear-gradient(300deg, rgba(222, 222, 222, 0.03) 0%, rgba(222, 222, 222, 0.03) 7%,rgba(67, 67, 67, 0.03) 7%, rgba(67, 67, 67, 0.03) 18%,rgba(61, 61, 61, 0.03) 18%, rgba(61, 61, 61, 0.03) 26%,rgba(32, 32, 32, 0.03) 26%, rgba(32, 32, 32, 0.03) 52%,rgba(119, 119, 119, 0.03) 52%, rgba(119, 119, 119, 0.03) 60%,rgba(252, 252, 252, 0.03) 60%, rgba(252, 252, 252, 0.03) 68%,rgba(9, 9, 9, 0.03) 68%, rgba(9, 9, 9, 0.03) 100%),linear-gradient(496deg, rgba(193, 193, 193, 0.03) 0%, rgba(193, 193, 193, 0.03) 12%,rgba(184, 184, 184, 0.03) 12%, rgba(184, 184, 184, 0.03) 24%,rgba(194, 194, 194, 0.03) 24%, rgba(194, 194, 194, 0.03) 43%,rgba(128, 128, 128, 0.03) 43%, rgba(128, 128, 128, 0.03) 54%,rgba(87, 87, 87, 0.03) 54%, rgba(87, 87, 87, 0.03) 71%,rgba(169, 169, 169, 0.03) 71%, rgba(169, 169, 169, 0.03) 93%,rgba(83, 83, 83, 0.03) 93%, rgba(83, 83, 83, 0.03) 100%),linear-gradient(202deg, rgba(186, 186, 186, 0.03) 0%, rgba(186, 186, 186, 0.03) 9%,rgba(77, 77, 77, 0.03) 9%, rgba(77, 77, 77, 0.03) 19%,rgba(38, 38, 38, 0.03) 19%, rgba(38, 38, 38, 0.03) 27%,rgba(203, 203, 203, 0.03) 27%, rgba(203, 203, 203, 0.03) 39%,rgba(130, 130, 130, 0.03) 39%, rgba(130, 130, 130, 0.03) 43%,rgba(184, 184, 184, 0.03) 43%, rgba(184, 184, 184, 0.03) 81%,rgba(108, 108, 108, 0.03) 81%, rgba(108, 108, 108, 0.03) 100%),linear-gradient(168deg, rgb(107, 4, 15),rgb(240, 4, 35));

        /* border-bottom: 6px solid #ff253a !important; */
        padding-bottom: 0px !important;
        /* background-color: #ff253a !important; */
        scale: 1.4;
        /* border-radius: 50% !important; */
        animation: shape 2s linear infinite;


    }

    .activeTabb3 a,
    .activeTabb2 a,
    .activeTabb1 a {
        color: #fff !important;
        font-weight: bold;
    }

    @keyframes shape {

        0%,
        100% {
            border-radius:
                40% 60% 70% 30% / 40% 40% 60% 50%;
        }

        33% {
            border-radius:
                70% 30% 50% 50% / 30% 30% 70% 70%;
        }

        66% {
            border-radius:
                100% 60% 60% 100% / 100% 100% 60% 60%;
        }
    }


    .tabli {
        background-color: #cecaca;
        border-radius: 5px 5px 0px 0px;
    }



    .card2 {
        height: 50px;
        position: relative;
        box-shadow: none;
        display: flex;
        justify-content: space-between;
        margin: 10px;
        border-radius: 5px;
        background-color: #fff;
        text-align: left;

        transition: all .5s;
    }

    .card-img-container {
        background: url(https://picsum.photos/300/300) center center no-repeat;
        background-size: cover;
        height: 200px;
        width: auto;
        border-radius: 5px 5px 0 0;
        filter: contrast(2) invert(0.2) sepia(0.7);
        transition: .4s all;
    }

    .card:hover .card-img-container {
        filter: none;
    }

    .card-text-container {
        padding: 20px;
        overflow: hidden;
    }

    .card-text-container.expanded {
        height: 500px;
    }

    .card-text-container h2,
    .card-text-container p {
        color: #13505c;
    }





    .card-link-container {
        height: 50px;
        position: absolute;
        bottom: 0;
        padding: 10px 20px 10px 20px;
    }

    .card-link-container a {
        color: #892f23;
        font-size: 18px;
        font-weight: bold;
    }

    .more-link:hover {
        cursor: pointer;
    }

    .filter-btn-row {
        text-align: center;
        margin-bottom: 30px;
    }

    .filter-btn {
        margin: 5px;
        width: 100px;
        font-size: 18px;
    }

    .selected {

        color: #fff;
        box-shadow: none;

    }



    .products li {
        padding: 10px;
        background-color: #fff;
    }



    .vendors .active {

        scale: 1.6;

        padding 30px;

        top: 10px;

        padding: 10px !important;

        border-radius: 50% !important;

        box-shadow: 2px 2px 9px 2px #6c6969b5 !important;


    }

    .active {}

    .card-location {
        display: none;
        font-weight: bold;
    }


    .tabli {
        background-color: #cec9c9;
        border-radius: 5px 5px 0px 0px;
    }

    @media screen and (min-width: 0) and (max-width: 425px) {
        .filtered-cards {
            padding: 0;
        }

        .card {
            margin: 0px;
            margin-top: 20px;
            border-radius: 5px;

            text-align: left;

        }

        .filter-btn {
            width: 100px;
            font-size: 18px;
            margin: 10px;
        }
    }

    /** Remove img filter on mobile **/
    @media screen and (min-width: 0) and (max-width: 768px) {
        .card-img-container {
            filter: none;
        }
    }

    /*
        .card:hover {
            box-shadow: 2px 3px 12px 0px rgba(248, 70, 70, 0.75);

        } */


    .sampleFont {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
    }


    .vazirFont {
        font-family: "vazir" !important;
    }








    .tabli {
        background-color: #cecaca;
        border-radius: 5px 5px 0px 0px;
    }


    #product_img {

        border-bottom: 2px solid rgb(70, 70, 70);
        margin: 2px 2px !important;
        padding: 2px 2px !important;
    }


    @media screen and (max-width: 600px) {
        .Sort-items {
            margin-top: -30px;
        }
    }




    .card2 {
        height: 50px;
        position: relative;
        box-shadow: none;
        display: flex;
        justify-content: space-between;
        margin: 10px;
        border-radius: 5px;
        background-color: #fff;
        text-align: left;

        transition: all .5s;
    }

    .card-img-container {
        background: url(https://picsum.photos/300/300) center center no-repeat;
        background-size: cover;
        /* height: 200px; */
        width: auto;
        border-radius: 5px 5px 0 0;
        filter: contrast(2) invert(0.2) sepia(0.7);
        transition: .4s all;
    }

    .card:hover .card-img-container {
        filter: none;
    }

    .card-text-container {
        padding: 20px;
        overflow: hidden;
    }

    .card-text-container.expanded {
        height: 500px;
    }

    .card-text-container h2,
    .card-text-container p {
        color: #13505c;
    }





    .card-link-container {
        height: 50px;
        position: absolute;
        bottom: 0;
        padding: 10px 20px 10px 20px;
    }

    .card-link-container a {
        color: #892f23;
        font-size: 18px;
        font-weight: bold;
    }

    .more-link:hover {
        cursor: pointer;
    }

    .filter-btn-row {
        text-align: center;
        margin-bottom: 30px;
    }

    .filter-btn {
        margin: 5px;
        width: 100px;
        font-size: 18px;
    }

    .selected {

        border: 2px solid #f0862c;
        color: #fff;
        box-shadow: none;
    }

    .card-location {
        display: none;
        font-weight: bold;
    }

    @media screen and (min-width: 0) and (max-width: 425px) {
        .filtered-cards {
            padding: 0;
        }

        .card {
            margin: 0px;
            margin-top: 20px;
            border-radius: 5px;

            text-align: left;

        }

        .filter-btn {
            width: 100px;
            font-size: 18px;
            margin: 10px;
        }
    }

    /** Remove img filter on mobile **/
    @media screen and (min-width: 0) and (max-width: 768px) {
        .card-img-container {
            filter: none;
        }
    }

    @media screen and (min-width: 768px) {

        .card {
            /* padding: 0 !important; */
            /* margin: 10px 0px ; */
            /* width: 280px !important; */
            overflow: hidden;
            /* box-shadow: none; */
            border-radius: 5px;
            text-align: left;
            transition: all .5s;
        }






    }

    .all {
        justify-content: flex-start;
    }

    .productImgDiv {
        width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
        overflow: hidden;
    }

    /* .productCard{
            justify-content: space-between; border: none;
        } */
    /*
        .card:hover {
            box-shadow: 2px 3px 12px 0px rgba(248, 70, 70, 0.75);

        } */

    .card2 {
        height: 50px;
        position: relative;
        box-shadow: none;
        display: flex;
        justify-content: space-between;
        margin: 10px;
        border-radius: 5px;
        background-color: #fff;
        text-align: left;
        transition: all .5s;
    }

    .card-img-container {
        background: url(https://picsum.photos/300/300) center center no-repeat;
        background-size: cover;
        height: 200px;
        width: auto;
        border-radius: 5px 5px 0 0;
        filter: contrast(2) invert(0.2) sepia(0.7);
        transition: .4s all;
    }

    .card:hover .card-img-container {
        filter: none;
    }

    .card-text-container {
        padding: 20px;
        overflow: hidden;
    }

    .card-text-container.expanded {
        height: 500px;
    }

    .card-text-container h2,
    .card-text-container p {
        color: #13505c;
    }




    .card-link-container {
        height: 50px;
        position: absolute;
        bottom: 0;
        padding: 10px 20px 10px 20px;
    }

    .card-link-container a {
        color: #892f23;
        font-size: 18px;
        font-weight: bold;
    }

    .more-link:hover {
        cursor: pointer;
    }

    .filter-btn-row {
        text-align: center;
        margin-bottom: 30px;
    }

    .filter-btn {
        margin: 5px;
        width: 100px;
        font-size: 18px;
    }

    .selected {

        color: #fff;
        box-shadow: none;

    }



    .products li {
        padding: 10px;
        background-color: #fff;
    }



    .vendors .active {

        scale: 1.2;

        padding 30px;

        top: 10px;

        padding: 10px !important;

        border-radius: 50% !important;

        box-shadow: 2px 2px 9px 2px #6c6969b5 !important;


    }

    .active {}

    .card-location {
        display: none;
        font-weight: bold;
    }


    .tabli {
        background-color: #cec9c9;
        border-radius: 5px 5px 0px 0px;
    }

    @media screen and (min-width: 0) and (max-width: 425px) {
        .filtered-cards {
            padding: 0;
        }

        .card {
            margin: 0px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: left;
        }

        .filter-btn {
            width: 100px;
            font-size: 18px;
            margin: 10px;
        }

    }

    /** Remove img filter on mobile **/
    @media screen and (min-width: 0) and (max-width: 768px) {
        .card-img-container {
            filter: none;
        }

    }


    /* .card:hover {
            box-shadow: 2px 3px 12px 0px rgba(248, 70, 70, 0.75);

        } */
    .onmouseover {
        margin-left: 5px !important;
    }

    .sampleFont {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
    }


    .vazirFont {
        font-family: "vazir" !important;
    }


    /* .activeTabb1 {

        color: #ffff !important;
        background-color: #fee0ec !important;

        border: none !important;

        border-bottom: 6px solid #fee0ec !important;
        padding-bottom: 0px !important;

    } */





    .tabli {
        background-color: #cecaca;
        border-radius: 5px 5px 0px 0px;
    }

    body {
        overflow-x: hidden !important;
        transition: all 0.5s;

    }

    body::-webkit-scrollbar {
        display: none;
    }

    .show {

        display: block !important;
        transition: all 1s;

    }

    .BtOpenCloseFilte {
        display: none;
    }

    @media (max-width: 575.98px) {
        .BtOpenCloseFilte {
            display: block !important;
        }

        #formFilter {
            display: none;

        }

        .TopBarOfProductsPage {
            display: flex;
            flex-direction: column !important;
        }

    }


    .filter-container {
        padding-bottom: 100px;
    }

    @media screen and (max-width: 769px) {


        .productCard {

            font-size: 13px;




            height: 320px;
        }

        .all {

            margin: 0 auto;
            padding: 10px;
        }

        .product_name {
            line-height: 23px !important;

        }

        .product_p {
            widows: 50%;
        }



    }

    @media screen and (min-width: 769px) {
        .pagination {
            margin: 0 50% 20px 0 !important;

        }
    }
</style>

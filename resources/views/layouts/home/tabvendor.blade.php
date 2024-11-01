<style>
    .vendorsss {
        margin-top: 33px !important;
    }




    .vendorsss .active1 {

        scale: 1.3;



        background-color: #ffff;
        padding: 0px !important;

        margin-left: 10px !important;


        border: none !important;

        margin-right: 10px !important;


        height: 30px !important;
        border-radius: 10% 10% 0px 0px !important;
        margin-top: 10px !important;




    }

    #scrolllll::-webkit-scrollbar {
        display: none;
    }

    @keyframes anim1 {
        0% {
            transform: scale(1);
            /* z-index: 1; */
            height: 100px;

        }



        100% {
            transform: scale(1.3);
            /* z-index: 100; */
            height: 222px;
            /* opacity: 1; */
        }
    }

    @keyframes anim2 {
        0% {
            transform: scale(1.3);
            /* z-index: 100; */
            height: 222px;

        }

        30% {
            opacity: .8;
        }

        to {
            transform: scale(1);
            /* z-index: 1; */
            height: 100px;
            opacity: 1;

        }
    }

    @keyframes nonedisplay {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .containner {
        margin: 20px auto;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

    }


    .box {
        width: 70%;
        height: 100px;
        transform: scale(1);
        transition: all .10s;
        display: none;
        animation: nonedisplay alternate 1s;
    }




    .box1 {
        width: 70%;
        height: 100px;
        transform: scale(1);
        transition: all .10s;
        display: none;
        animation: nonedisplay alternate 1s;
    }


    .box2 {
        width: 70%;
        height: 100px;
        transform: scale(1);
        transition: all .10s;
        display: none;
        animation: nonedisplay alternate 1s;
    }

    .box3 {
        width: 70%;
        height: 100px;
        transform: scale(1);
        transition: all .10s;
        display: none;
        animation: nonedisplay alternate 1s;
    }



    .prev {
        order: 1;
        display: flex;
        animation: anim2 alternate 1s;

        /* align-items: flex-start !important;
        padding: 0 !important; */
        flex-direction: column;

        padding: 15px;
        align-items: flex-end;
    }

    .prev1 {
        order: 1;
        display: flex;
        animation: anim2 alternate 1s;
        flex-direction: column;
        justify-content: space-around !important;
        /* align-items: flex-start !important; */

        padding: 0 !important;
    }

    .prev2 {
        order: 1;
        display: flex;
        animation: anim2 alternate 1s;
        flex-direction: column;

        justify-content: space-around !important;
        /* align-items: flex-start !important; */
        padding: 0 !important;
    }

    .prev3 {
        order: 1;
        display: flex;
        animation: anim2 alternate 1s;
        flex-direction: column;

        justify-content: space-around !important;
        /* align-items: flex-start !important; */
        padding: 0 !important;
    }

    .next {
        order: 3;
        display: flex;
        flex-direction: column;

        padding: 15px;
        align-items: flex-end;

    }

    .next1 {
        order: 3;
        display: flex;
        flex-direction: column;

        padding: 15px;
        justify-content: space-around !important;

    }

    .next2 {
        order: 3;
        display: flex;
        flex-direction: column;

        padding: 15px;
        justify-content: space-around !important;

    }

    .next3 {
        order: 3;
        display: flex;
        flex-direction: column;

        padding: 15px;
        justify-content: space-around !important;

    }

    .activee {
        animation: anim1 forwards 1s;
        order: 2;
        display: flex;
        z-index: 100;
        display: flex;
        flex-direction: column;
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        scale: 1 !important;

    }

    .activee1 {
        animation: anim1 forwards 1s;
        order: 2;
        display: flex;
        z-index: 100;
        display: flex;
        flex-direction: column;
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        scale: 1 !important;

    }

    .activee2 {
        animation: anim1 forwards 1s;
        order: 2;
        display: flex;
        z-index: 100;
        display: flex;
        flex-direction: column;
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        scale: 1 !important;

    }

    .activee3 {
        animation: anim1 forwards 1s;
        order: 2;
        display: flex;
        z-index: 100;
        display: flex;
        flex-direction: column;
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        scale: 1 !important;

    }


    .activee .vendorproducts {


        opacity: 1 !important;
        display: flex;


    }

    .activee1 .vendorproducts {


        opacity: 1 !important;
        display: flex;


    }


    .activee2 .vendorproducts {


        opacity: 1 !important;
        display: flex;


    }


    .activee3 .vendorproducts {


        opacity: 1 !important;
        display: flex;


    }


    .activetab1 {
        scale: 1.4;
        color: #ffff !important;
        background-color: #bdd9ed !important;
        border: none !important;
        border-bottom: 6px solid #bdd9ed !important;
        padding-bottom: 0px !important;
        animation: shape 2s linear infinite;
    }

    .activetab2 {

        scale: 1.4;
        color: #ffff !important;
        background-color: #0887e2 !important;

        border: none !important;

        border-bottom: 6px solid #0887e2 !important;
        padding-bottom: 0px !important;


        animation: shape 2s linear infinite;
    }

    .activetab3 {

        scale: 1.4;
        color: #ffff !important;
        background-color: #004475 !important;

        border: none !important;

        border-bottom: 6px solid #004475 !important;
        padding-bottom: 0px !important;


        animation: shape 2s linear infinite;

    }


    .activetab2 a,
    .activetab3 a {
        color: #ffff !important;

    }

    .active1 #mahV {

        border-radius: 10%;
        padding: 10px;
        width: 100% !important;
        height: 100% !important;
        background-color: #0887e2 !important;
    }


    .active1 #mosV {

        border-radius: 10%;
        padding: 10px;
        width: 100% !important;
        height: 100% !important;
        background-color: #004475 !important;
    }



    /* Chrome, Safari and Opera */

    @media only screen and (max-width: 900px) {

        /* .vendorproducts {
            display: none !important;
        } */
    }


    .ven-section {
        height: auto;
        width: 22%;
    }

    .ven-big-sec {
        width: 78%;
    }

    @media only screen and (max-width: 767px) {



        .ven-section {
            display: none;
        }

        .ven-big-sec {
            width: 100%;
        }




    }
</style>


<script>
    var time1;
    var time2;
    var time3;


    let n1um = 0;

    let n2um = 0;

    let n3um = 0;



    window.onload = function() {

        time1 = setInterval(() => {

            startTime1();
            startTime2();
            startTime3();

        }, 5000)

        // function startTime1() {
        //     let boxs1 = document.getElementsByClassName('box1');





        //     // other div0
        //     if (n1um != 0) {
        //         let n1um3 = n1um;
        //         let n1um4 = n1um;
        //         let pr = n1um;


        //         if (boxs1[boxs1.length - 1].classList.contains('prev')) {
        //             boxs1[boxs1.length - 1].classList.remove('prev')
        //         } else {
        //             pr -= 2
        //             boxs1[pr].classList.remove('prev')
        //             boxs1[pr].classList.remove('next')
        //         }
        //         --n1um3
        //         boxs1[n1um3].classList.replace('activee', 'prev')
        //         boxs1[n1um].classList.replace('next', 'activee')

        //         // boxs[n1um].classList.add('activee')

        //         if (n1um != boxs1.length - 1) {
        //             boxs1[++n1um4].classList.add('next')
        //         }


        //     }

        //     //first div
        //     else {


        //         boxs1[n1um].classList.remove('next');

        //         if (boxs1[boxs1.length - 1].classList.contains('activee')) {
        //             boxs1[boxs1.length - 1].classList.remove('activee')
        //             boxs1[boxs1.length - 2].classList.remove('prev')
        //         }
        //         boxs1[boxs1.length - 1].classList.add('prev')
        //         boxs1[n1um].classList.add('activee')

        //         let n1um2 = n1um;
        //         ++n1um2
        //         boxs1[n1um2].classList.add('next')
        //     }

        //     if (n1um === boxs1.length - 1) {
        //         boxs1[0].classList.remove('activee')
        //         boxs1[0].classList.add('next')
        //     }

        //     n1um++


        //     if (n1um === boxs1.length) {
        //         let pv = boxs1.length - 1
        //         boxs1[boxs1.length - 1].classList.remove('next')
        //         boxs1[boxs1.length - 1].classList.remove('prev')
        //             --pv


        //         boxs1[pv].classList.remove('next')
        //         boxs1[pv].classList.remove('activee')
        //         n1um = 0

        //     }

        // }

        // function startTime2() {
        //     let boxs2 = document.getElementsByClassName('box2');





        //     // other div0
        //     if (n2um != 0) {
        //         let n2um3 = n2um;
        //         let n2um4 = n2um;
        //         let pr = n2um;


        //         if (boxs2[boxs2.length - 1].classList.contains('prev')) {
        //             boxs2[boxs2.length - 1].classList.remove('prev')
        //         } else {
        //             pr -= 2
        //             boxs2[pr].classList.remove('prev')
        //             boxs2[pr].classList.remove('next')
        //         }
        //         --n2um3
        //         boxs2[n2um3].classList.replace('activee', 'prev')
        //         boxs2[n2um].classList.replace('next', 'activee')

        //         // boxs[n2um].classList.add('activee')

        //         if (n2um != boxs2.length - 1) {
        //             boxs2[++n2um4].classList.add('next')
        //         }


        //     }

        //     //first div
        //     else {

        //         boxs2[n2um].classList.remove('next');

        //         if (boxs2[boxs2.length - 1].classList.contains('activee')) {
        //             boxs2[boxs2.length - 1].classList.remove('activee')
        //             boxs2[boxs2.length - 2].classList.remove('prev')
        //         }
        //         boxs2[boxs2.length - 1].classList.add('prev')
        //         boxs2[n2um].classList.add('activee')

        //         let n2um2 = n2um;
        //         ++n2um2
        //         boxs2[n2um2].classList.add('next')
        //     }

        //     if (n2um === boxs2.length - 1) {
        //         boxs2[0].classList.remove('activee')
        //         boxs2[0].classList.add('next')
        //     }

        //     n2um++


        //     if (n2um === boxs2.length) {
        //         let pv = boxs2.length - 1
        //         boxs2[boxs2.length - 1].classList.remove('next')
        //         boxs2[boxs2.length - 1].classList.remove('prev')
        //             --pv


        //         boxs2[pv].classList.remove('next')
        //         boxs2[pv].classList.remove('activee')
        //         n2um = 0

        //     }

        // }

        // function startTime3() {
        //     let boxs = document.getElementsByClassName('box3');





        //     // other div0
        //     if (n3um != 0) {
        //         let n3um3 = n3um;
        //         let n3um4 = n3um;
        //         let pr = n3um;


        //         if (boxs[boxs.length - 1].classList.contains('prev')) {
        //             boxs[boxs.length - 1].classList.remove('prev')
        //         } else {
        //             pr -= 2
        //             boxs[pr].classList.remove('prev')
        //             boxs[pr].classList.remove('next')
        //         }
        //         --n3um3
        //         boxs[n3um3].classList.replace('activee', 'prev')
        //         boxs[n3um].classList.replace('next', 'activee')

        //         // boxs[n3um].classList.add('activee')

        //         if (n3um != boxs.length - 1) {
        //             boxs[++n3um4].classList.add('next')
        //         }


        //     }

        //     //first div
        //     else {

        //         boxs[n3um].classList.remove('next');

        //         if (boxs[boxs.length - 1].classList.contains('activee')) {
        //             boxs[boxs.length - 1].classList.remove('activee')
        //             boxs[boxs.length - 2].classList.remove('prev')
        //         }
        //         boxs[boxs.length - 1].classList.add('prev')
        //         boxs[n3um].classList.add('activee')

        //         let n3um2 = n3um;
        //         ++n3um2
        //         boxs[n3um2].classList.add('next')
        //     }

        //     if (n3um === boxs.length - 1) {
        //         boxs[0].classList.remove('activee')
        //         boxs[0].classList.add('next')
        //     }

        //     n3um++


        //     if (n3um === boxs.length) {
        //         let pv = boxs.length - 1
        //         boxs[boxs.length - 1].classList.remove('next')
        //         boxs[boxs.length - 1].classList.remove('prev')
        //             --pv


        //         boxs[pv].classList.remove('next')
        //         boxs[pv].classList.remove('activee')
        //         n3um = 0

        //     }

        // }

    }

    function startTime1(up = null) {
    let boxs1 = document.getElementsByClassName('box1');
    
    if (up) {
        let nextIndex = n1um;
        let nextNextIndex = n1um;
        nextNextIndex += 2;
        // console.log(++nextIndex);
        // console.log(n1um);
        boxs1[n1um].classList.replace('activee' , 'prev');
        boxs1[++nextIndex].classList.replace('next' , 'activee');
        boxs1[nextNextIndex].classList.add('next');

        // ........................................................................

    } else{
        if (n1um != 0) {
            // when other index
            let n1um3 = n1um;
            let n1um4 = n1um;
            let pr = n1um;

            if (boxs1[boxs1.length - 1].classList.contains('prev')) {
                boxs1[boxs1.length - 1].classList.remove('prev');
            } else {
                pr -= 2;
                boxs1[pr].classList.remove('prev');
                boxs1[pr].classList.remove('next');
            }

            --n1um3;
            boxs1[n1um3].classList.replace('activee', 'prev');
            boxs1[n1um].classList.replace('next', 'activee');

            if (n1um != boxs1.length - 1) {
                boxs1[++n1um4].classList.add('next');
            }
        } else {
            // when is first index
            boxs1[n1um].classList.remove('next');

            
            if (boxs1[boxs1.length - 1].classList.contains('activee')) {
                boxs1[boxs1.length - 1].classList.remove('activee');
                boxs1[boxs1.length - 2].classList.remove('prev');
            }

            boxs1[boxs1.length - 1].classList.add('prev');
            boxs1[n1um].classList.add('activee');

            let n1um2 = n1um;
            ++n1um2;
            boxs1[n1um2].classList.add('next');
        }

            // when index is equal to end
            if (n1um === boxs1.length - 1) {
            boxs1[0].classList.remove('activee');
            boxs1[0].classList.add('next');
        }


        // update index
        n1um++;


        // reset index
        if (n1um === boxs1.length) {
            let pv = boxs1.length - 1;
            boxs1[boxs1.length - 1].classList.remove('next');
            boxs1[boxs1.length - 1].classList.remove('prev');
            --pv;

            boxs1[pv].classList.remove('next');
            boxs1[pv].classList.remove('activee');
            n1um = 0;
        }
    }
    
//     if (up) {
       

//             // When moving backward
//         if (n1um !== 0) {
//         const nextIndex = n1um - 1;
//         const nextNextIndex = nextIndex - 1 >= 0 ? nextIndex - 1 : boxs1.length - 1;

//         if (boxs1[0].classList.contains('prev')) {
//             boxs1[0].classList.remove('prev');
//         } else {
//             boxs1[nextNextIndex].classList.remove('next');
//             boxs1[nextNextIndex].classList.remove('prev');
//         }

//         boxs1[nextIndex].classList.replace('activee', 'next');
//         boxs1[n1um].classList.replace('prev', 'activee');

//         if (n1um !== boxs1.length - 1) {
//             boxs1[n1um + 1].classList.add('next');
//         }
//         } else {
//         // When at the last index
//         boxs1[n1um].classList.remove('next');

//         if (boxs1[boxs1.length - 1].classList.contains('activee')) {
//             boxs1[boxs1.length - 1].classList.remove('activee');
//             boxs1[0].classList.remove('prev');
//         }

//         boxs1[0].classList.add('prev');
//         boxs1[n1um].classList.add('activee');

//         const prevIndex = n1um + 1;
//         boxs1[prevIndex].classList.add('next');
//         }

//         // When at the start index
//         if (n1um === boxs1.length - 1) {
//         boxs1[0].classList.remove('activee');
//         boxs1[0].classList.add('prev');
//         }

//         // Update index
//         n1um--;

//         // Reset index
//         if (n1um === -1) {
//         const prevIndex = boxs1.length - 2;
//         boxs1[boxs1.length - 1].classList.remove('next');
//         boxs1[boxs1.length - 1].classList.remove('prev');

//         boxs1[prevIndex].classList.remove('next');
//         boxs1[prevIndex].classList.remove('activee');

//         n1um = 0;
//         }

//         } else{
//                     // When moving forward
//             if (n1um !== 0) {
//                 const prevIndex = n1um - 1;
//                 const prevPrevIndex = prevIndex - 1 >= 0 ? prevIndex - 1 : boxs1.length - 1;

//                 if (boxs1[boxs1.length - 1].classList.contains('prev')) {
//                     boxs1[boxs1.length - 1].classList.remove('prev');
//                 } else {
//                     boxs1[prevPrevIndex].classList.remove('prev');
//                     boxs1[prevPrevIndex].classList.remove('next');
//                 }

//                 boxs1[prevIndex].classList.replace('activee', 'prev');
//                 boxs1[n1um].classList.replace('next', 'activee');

//                 if (n1um !== boxs1.length - 1) {
//                     boxs1[n1um + 1].classList.add('next');
//                 }
//             } else {
//                 // When at the first index
//                 boxs1[n1um].classList.remove('next');

//                 if (boxs1[boxs1.length - 1].classList.contains('activee')) {
//                     boxs1[boxs1.length - 1].classList.remove('activee');
//                     boxs1[boxs1.length - 2].classList.remove('prev');
//                 }

//                 boxs1[boxs1.length - 1].classList.add('prev');
//                 boxs1[n1um].classList.add('activee');

//                 const nextIndex = n1um + 1;
//                 boxs1[nextIndex].classList.add('next');
//             }

//             // When at the end index
//             if (n1um === boxs1.length - 1) {
//                 boxs1[0].classList.remove('activee');
//                 boxs1[0].classList.add('next');
//             }

//             // Update index
//             n1um++;

//             // Reset index
//             if (n1um === boxs1.length) {
//                 const prevIndex = boxs1.length - 2;
//                 boxs1[boxs1.length - 1].classList.remove('next');
//                 boxs1[boxs1.length - 1].classList.remove('prev');

//                 boxs1[prevIndex].classList.remove('next');
//                 boxs1[prevIndex].classList.remove('activee');

//                 n1um = 0;
//             }

//             console.log('asasd')

//    }


   
}



    
}



    function startTime2(up = null) {
        let boxs2 = document.getElementsByClassName('box2');





        // other div0
        if (n2um != 0) {
            let n2um3 = n2um;
            let n2um4 = n2um;
            let pr = n2um;


            if (boxs2[boxs2.length - 1].classList.contains('prev')) {
                boxs2[boxs2.length - 1].classList.remove('prev')
            } else {
                pr -= 2
                boxs2[pr].classList.remove('prev')
                boxs2[pr].classList.remove('next')
            }
            --n2um3
            boxs2[n2um3].classList.replace('activee', 'prev')
            boxs2[n2um].classList.replace('next', 'activee')

            // boxs[n2um].classList.add('activee')

            if (n2um != boxs2.length - 1) {
                boxs2[++n2um4].classList.add('next')
            }


        }

        //first div
        else {

            boxs2[n2um].classList.remove('next');

            if (boxs2[boxs2.length - 1].classList.contains('activee')) {
                boxs2[boxs2.length - 1].classList.remove('activee')
                boxs2[boxs2.length - 2].classList.remove('prev')
            }
            boxs2[boxs2.length - 1].classList.add('prev')
            boxs2[n2um].classList.add('activee')

            let n2um2 = n2um;
            ++n2um2
            boxs2[n2um2].classList.add('next')
        }

        if (n2um === boxs2.length - 1) {
            boxs2[0].classList.remove('activee')
            boxs2[0].classList.add('next')
        }

        n2um++


        if (n2um === boxs2.length) {
            let pv = boxs2.length - 1
            boxs2[boxs2.length - 1].classList.remove('next')
            boxs2[boxs2.length - 1].classList.remove('prev')
                --pv


            boxs2[pv].classList.remove('next')
            boxs2[pv].classList.remove('activee')
            n2um = 0

        }

    }

    function startTime3(up = null) {
        let boxs = document.getElementsByClassName('box3');





        // other div0
        if (n3um != 0) {
            let n3um3 = n3um;
            let n3um4 = n3um;
            let pr = n3um;


            if (boxs[boxs.length - 1].classList.contains('prev')) {
                boxs[boxs.length - 1].classList.remove('prev')
            } else {
                pr -= 2
                boxs[pr].classList.remove('prev')
                boxs[pr].classList.remove('next')
            }
            --n3um3
            boxs[n3um3].classList.replace('activee', 'prev')
            boxs[n3um].classList.replace('next', 'activee')

            // boxs[n3um].classList.add('activee')

            if (n3um != boxs.length - 1) {
                boxs[++n3um4].classList.add('next')
            }


        }

        //first div
        else {

            boxs[n3um].classList.remove('next');

            if (boxs[boxs.length - 1].classList.contains('activee')) {
                boxs[boxs.length - 1].classList.remove('activee')
                boxs[boxs.length - 2].classList.remove('prev')
            }
            boxs[boxs.length - 1].classList.add('prev')
            boxs[n3um].classList.add('activee')

            let n3um2 = n3um;
            ++n3um2
            boxs[n3um2].classList.add('next')
        }

        if (n3um === boxs.length - 1) {
            boxs[0].classList.remove('activee')
            boxs[0].classList.add('next')
        }

        n3um++


        if (n3um === boxs.length) {
            let pv = boxs.length - 1
            boxs[boxs.length - 1].classList.remove('next')
            boxs[boxs.length - 1].classList.remove('prev')
                --pv


            boxs[pv].classList.remove('next')
            boxs[pv].classList.remove('activee')
            n3um = 0

        }

    }


    function up(which) {

        switch (which) {
            case "startTime1":
                startTime1('up')
                
                break;
            case "startTime2":
                startTime2('up')
                break;
            case "startTime3":
                startTime3('up')
                break;

            default:
                break;
        }
    }


    function down(which) {


        switch (which) {
            case "startTime1":
                startTime1()
                
                console.log('asdsads')
                break;
            case "startTime2":
                startTime2()
                break;
            case "startTime3":
                startTime3()
                break;

            default:
                break;
        }
    }
</script>


{{-- فروشگاه ها شروع --}}
<div class="container mt-3">
    <a href="{{ route('Vendors.list') }}" class=" text-center ">
        <h2 style="font-family:'dastnevis' !important;">فروشندگان</h2>
    </a>
</div>


<div id="exTab3" class="container pt-4">
    <ul class="nav  nav-tabs">
        <li class="activetab1" style="border: 1px solid #9e9a9a; background-color: #ffff; padding:15px; color:black;">
            <a class="iransansmedium" id="spcV" style="color:black;"
                onclick="  
                  $('.activetab2').removeClass('activetab2'); $('.activetab3').removeClass('activetab3'); $(this).parent().addClass('activetab1');
                  $('#4').removeClass('tab-pane'); 
                  $('#6').addClass('tab-pane'); 
                  $('#5').addClass('tab-pane');
                  "
                data-toggle="tab">برگزیده</a>
        </li>
        <li style="border: 1px solid #9e9a9a; background-color: #ffff; padding:15px;">
            <a class="iransansmedium" id="mahV" style="color:rgb(255, 255, 255);"
                onclick="    $('.activetab1').removeClass('activetab1');$('.activetab3').removeClass('activetab3'); $(this).parent().addClass('activetab2'); 
                  $('#5').removeClass('tab-pane'); 
                  $('#4').addClass('tab-pane'); 
                  $('#6').addClass('tab-pane'); 


                  "
                data-toggle="tab">محبوب</a>
        </li>
        <li style="border:1px solid #9e9a9a; background-color: #ffff; padding:15px;">
            <a class="iransansmedium" id="mosV" style="color:black;"
                onclick="   $('.activetab1').removeClass('activetab1');$('.activetab2').removeClass('activetab2'); $(this).parent().addClass('activetab3'); 
                  $('#6').removeClass('tab-pane'); 
                  $('#4').addClass('tab-pane'); 
                  $('#5').addClass('tab-pane');
                      "
                data-toggle="tab">پرمحصول</a>
        </li>
    </ul>

    {{-- @dd($specialVendors); --}}
    <div class="tab-content " style="">
        <div class=" active1" id="4">

            <div class="tabvizhe"
                style="height: 500px; background-color: #bdd9ed; display: flex; justify-content: space-around ;border-radius: 25px;
                box-shadow: 2px 2px 7px 2px #888888d3;">

                <div class="ven-section row align-items-center">


                    <img loading="lazy" src="{{ url(env('PRODUCT_WHITEMANS') . 'superman.gif') }}"
                        class="whitemanproductgif" style="" alt="">

                </div>

                <div class="row ven-big-sec" style="position: relative;">

                    <span class="btn btn-dark btn-vendor-prev" style="position: absolute;top:0;"
                        onclick="up('startTime1')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                          </svg>
                    </span>

                    <div class="containner" style="display: flex; justify-content: space-between">




                        @for ($i = 0; $i < count($specialVendors); $i++)
                            @if (!is_null($specialVendors[$i]->vendor))
                                <div class="col-12 bg-white box box1 border-25 p-2  @if ($i == 0) activee  @elseif($i == 1) next   @elseif($i == count($specialVendors) && count($specialVendors) > 2) prev @endif "
                                    style="">


                                    <div class="" style="display: flex;  justify-content: start;  width: 100%;">
                                        <img loading="lazy"
                                            style=" margin:5px 0px 0px 0px;   border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover; width:40px; height:40px;"class=""
                                            src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $specialVendors[$i]->vendor->avatar) }}"
                                            data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $specialVendors[$i]->vendor->name) }}"
                                            alt="" />


                                        <a style=" color:black; font-size:20px; padding:10px;  "
                                            href="{{ route('vendor.home', ['vendor' => $specialVendors[$i]->vendor->name]) }}"
                                            class=" ">
                                            {{ $specialVendors[$i]->vendor->title }}
                                        </a>

                                        {{-- 
                                        <div class="   " style="width: 50%; ">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>


                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>


                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>





                                        </div> --}}

                                        {{-- <div id="Address">

                                            <a class="btn btn-outline-primary m-1"
                                                style=" width:150px; border:1px solid blue; border-radius:10%;"
                                                href="{{ route('vendor.home', ['vendor' => $specialVendors[$i]->vendor->name]) }}">
                                                مشاهده
                                                فروشگاه</a>

                                        </div> --}}



                                    </div>



                                    <div
                                        style=" opacity: 0;overflow-x:scroll;white-space: nowrap;  "class="vendorproducts d-block p-2 p-md-1">

                                        @foreach ($specialVendors[$i]->vendor->home_products as $product)
                                            <!-- Card image -->
                                            <a class="card p-1 d-inline-block" style="width:100px; "
                                                href="{{ route('products.show', ['vendor' => $specialVendors[$i]->vendor->name, 'product' => $product->slug]) }}">


                                                <div class=""
                                                    style=" text-align: center; border-radius: 10px;   ">
                                                    <div style="max-width: 100%;height:80px; text-align: center;"
                                                        class="">

                                                        <img class=""
                                                            style="max-width: 100%; height:inherit;border-radius: 10px;"
                                                            alt="{{ $product->name }}"
                                                            src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image()) }}"
                                                            data-loaded="true">



                                                    </div>

                                                    <div class="">
                                                        <!-- Title -->
                                                        <p class="iransansmedium text-truncate px-1 text-center"
                                                            style="font-size:8px;">


                                                            {{ $product->name }}

                                                        </p>
                                                        <!-- Button -->
                                                        <?php if($product->product_price !=null ) { ?>
                                                        <p class="iransansmedium"
                                                            style="width: 100%; text-align:center !important; font-size:10px;">
                                                            قیمت
                                                            <small
                                                                style="width: 100%; text-align:start !important; font-size:8px;"
                                                                class="text-center texr-danger text-truncate px-1">
                                                                {{ $product->product_price }}
                                                            </small>
                                                            تومان
                                                        </p>
                                                        <?php }else{ ?>
                                                        <p class="iransansmedium text-truncate px-1"
                                                            style="width: 100%; text-align:center !important;  font-size:8px;">
                                                            قیمت : -
                                                        </p>
                                                        <?php } ?>


                                                    </div>




                                                </div>

                                            </a>
                                        @endforeach


                                    </div>

                                </div>
                            @endif
                        @endfor


                    </div>


                    <span class="btn btn-dark btn-vendor-next" style="position: absolute;bottom:0;"
                        onclick="down('startTime1')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                          </svg></span>
                </div>

            </div>

        </div>




        <!-- other tabs -->
        <div class="tab-pane" id="5">

            <div class="tabvizhe"
                style="height: 500px; background-color: #0887e2;  display: flex; justify-content: space-around;border-radius: 25px;
                box-shadow: 2px 2px 7px 2px #888888d3;
                ">
                <div class="ven-section row align-items-center">


                    <img loading="lazy" src="{{ url(env('PRODUCT_WHITEMANS') . 'sabz.gif') }}"
                        class="whitemanproductgif" style="width:80%;" alt="">
                </div>

                <div class="row ven-big-sec" style="position: relative;">

                    <span class="btn btn-dark btn-vendor-prev" onclick="up('startTime2')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                          </svg>
                    </span>

                    <div class="containner " style="display: flex; justify-content: space-between">


                        @for ($i = 0; $i < count($most_product_vendors); $i++)


                            <div class="col-12 bg-white box box2 border-25 p-2  @if ($i == 0) activee  @elseif($i == 1) next   @elseif($i == count($most_product_vendors) && count($most_product_vendors) > 2) prev @endif "
                                style="">


                                <div class="" style="display: flex;  justify-content: start;  width: 100%;">
                                    <img loading="lazy"
                                        style=" margin:5px 0px 0px 0px;   border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover; width:40px; height:40px;"class=""
                                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $most_product_vendors[$i]->avatar) }}"
                                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $most_product_vendors[$i]->name) }}"
                                        alt="" />


                                    <a style=" color:black; font-size:20px; padding:10px "
                                        href="{{ route('vendor.home', ['vendor' => $most_product_vendors[$i]->name]) }}"
                                        class=" ">
                                        {{ $most_product_vendors[$i]->title }}
                                    </a>


                                    {{-- <div class="   " style="width: 50%; ">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>


                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#FFD700	" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>





                                    </div> --}}

                                    {{-- <div id="Address">

                                        <a class="btn btn-outline-primary  m-1"
                                            style=" width:150px; border:1px solid blue; border-radius:10%;"
                                            href="{{ route('vendor.home', ['vendor' => $most_product_vendors[$i]->name]) }}">
                                            مشاهده
                                            فروشگاه</a>

                                    </div> --}}



                                </div>



                                <div
                                    style=" opacity: 0;overflow-x:scroll;white-space: nowrap;  "class="vendorproducts d-block p-2 p-md-1">

                                    @foreach ($most_product_vendors[$i]->home_products as $product)
                                        <!-- Card image -->
                                        <a class="card p-1 d-inline-block" style="width:100px; "
                                            href="{{ route('products.show', ['vendor' => $most_product_vendors[$i]->name, 'product' => $product->slug]) }}">
                                            <div style="max-width: 100%;height:80px; text-align: center;"
                                                class="">
                                                <img class=""
                                                    style="max-width: 100%; height:inherit;border-radius: 10px;"
                                                    alt="{{ $product->name }}"
                                                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                                    data-loaded="true">



                                            </div>

                                            <div class="">
                                                <!-- Title -->
                                                <p class="iransansmedium text-truncate px-1 text-center"
                                                    style="font-size:8px;">


                                                    {{ $product->name }}

                                                </p>
                                                <!-- Button -->
                                                <?php if($product->product_price !=null ) { ?>
                                                <p class="iransansmedium text-truncate px-1" style="font-size:8px;">
                                                    قیمت
                                                    <small
                                                        style="width: 100%; text-align:center !important; font-size:8px;"
                                                        class="text-center texr-danger">
                                                        {{ $product->product_price }}
                                                    </small>
                                                    تومان
                                                </p>
                                                <?php }else{ ?>
                                                <p class="iransansmedium text-truncate px-1"
                                                    style="width: 100%; text-align:center !important;  font-size:8px;">
                                                    قیمت : -
                                                </p>
                                                <?php } ?>


                                            </div>
                                            <!--/ Card content -->
                                        </a>
                                    @endforeach


                                </div>

                            </div>
                        @endfor


                    </div>

                    <span class="btn btn-dark btn-vendor-next" onclick="down('startTime2')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                      </svg></span>





                </div>
            </div>
        </div>
        <div class="tab-pane" id="6">
            <div class="tabvizhe"
                style="height: 500px; background-color: #004475;  display: flex; justify-content: space-around;border-radius: 25px;
                box-shadow: 2px 2px 7px 2px #888888d3;">
                <div class="ven-section row align-items-center">


                    <img loading="lazy" src="{{ url(env('PRODUCT_WHITEMANS') . 'charkh.gif') }}"
                        class="whitemanproductgif" style="" alt="">

                </div>

                <div class="row ven-big-sec" style="position: relative;">

                    <span class="btn btn-dark btn-vendor-prev" onclick="up('startTime3')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                          </svg>
                    </span>

                    <div class="containner " style="display: flex; justify-content: space-between">


                        @for ($i = 0; $i < count($popularVendorrs); $i++)

                            <div class="col-12 bg-white box box3 border-25 p-2   @if ($i == 0) activee  @elseif($i == 1) next   @elseif($i == count($popularVendorrs) && count($popularVendorrs) > 2) prev @endif "
                                style="">


                                <div class="" style="display: flex;  justify-content: start;  width: 100%;">
                                    <img loading="lazy"
                                        style=" margin:5px 0px 0px 0px;   border-radius: 50%; border:1px solid black; padding:3px; object-fit: cover; width:40px; height:40px;"class=""
                                        src="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $popularVendorrs[$i]->avatar) }}"
                                        data-zoom-image="{{ asset(env('VENDOR_IMAGES_AVATAR_UPLOAD_PATH') . $popularVendorrs[$i]->name) }}"
                                        alt="" />


                                    <a style=" color:black; font-size:20px; padding:10px; "
                                        href="{{ route('vendor.home', ['vendor' => $popularVendorrs[$i]->name]) }}"
                                        class=" ">
                                        {{ $popularVendorrs[$i]->title }}
                                    </a>









                                    {{-- <div id="Address">

                                        <a class="btn btn-outline-primary m-1"
                                            style=" width:150px; border:1px solid blue; border-radius:10%;"
                                            href="{{ route('vendor.home', ['vendor' => $popularVendorrs[$i]->name]) }}">
                                            مشاهده
                                            فروشگاه</a>

                                    </div> --}}



                                </div>



                                <div
                                    style=" opacity: 0;overflow-x:scroll;white-space: nowrap;   "class="vendorproducts d-block p-2 p-md-1">

                                    @foreach ($popularVendorrs[$i]->home_products as $product)
                                        <!-- Card image -->
                                        <a class="card p-1 d-inline-block" style="width:100px;"
                                            href="{{ route('products.show', ['vendor' => $product->name, 'product' => $product->slug]) }}">
                                            <div style="max-width: 100%;height:80px; text-align: center;"
                                                class="">
                                                <img class=""
                                                    style="max-width: 100%; height:inherit;border-radius: 10px; "
                                                    alt="{{ $product->name }}"
                                                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                                                    data-loaded="true">



                                            </div>

                                            <div class="text-center">
                                                <!-- Title -->
                                                <p class="iransansmedium text-truncate px-1 text-center"
                                                    style="font-size:8px;">


                                                    {{ $product->name }}

                                                </p>
                                                <!-- Button -->
                                                <?php if($product->product_price !=null ) { ?>
                                                <p class="iransansmedium text-truncate px-1" style=font-size:8px;">
                                                    قیمت
                                                    <small
                                                        style="width: 100%; text-align:start !important; font-size:10px;"
                                                        class="text-center texr-danger">
                                                        {{ $product->product_price }}
                                                    </small>
                                                    تومان
                                                </p>
                                                <?php }else{ ?>
                                                <p class="iransansmedium text-truncate px-1" style="font-size:8px;">
                                                    قیمت : -
                                                </p>
                                                <?php } ?>


                                            </div>
                                            <!--/ Card content -->
                                        </a>
                                    @endforeach


                                </div>

                            </div>
                        @endfor


                    </div>
                    <span class="btn btn-dark btn-vendor-next" onclick="down('startTime3')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                      </svg></span>


                </div>


            </div>

        </div>
    </div>
</div>

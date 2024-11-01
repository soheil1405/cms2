
<style>
    .headerDropDownBt{
        margin-left: 30px;

    }
    .headerDropDownBt:hover{
        background-color: rgb(243, 239, 239);
    }
</style>

<script>
    
    function CategoryShow(){
        // document.getElementById('DivBrands').style.display="none";
        // document.getElementById('DivCats').style.display="block";
        document.getElementById('DivBrands').style.opacity=0;
        document.getElementById('DivCats').style.opacity=1;
    }
    function CategoryHide(){
        // document.getElementById('DivCats').style.display="none";
        document.getElementById('DivCats').style.opacity=0;


    }


    function BransShow(){

        // document.getElementById('DivCats').style.display="none";
        // document.getElementById('DivBrands').style.display="block";

        document.getElementById('DivCats').style.opacity=0;
        document.getElementById('DivBrands').style.opacity=1;

    }
    function BrandHide(){
        // document.getElementById('DivBrands').style.display="none";
        document.getElementById('DivBrands').style.opacity=0;


    }
</script>







<div class="col-md-6" style="margin: 10px auto;">
    <i   class="bi bi-funnel-fill"></i>

    <a  class="headerDropDownBt" onmouseover="CategoryShow()" onmouseout="CategoryHide()"  style="padding:5px;">
          دسته بندی محصول 
    
          <small><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
          </svg>
        </small> 
    </a>
    <a  onmouseover="BransShow()" onmouseout="BrandHide()" class="headerDropDownBt" style="padding:5px;">
        برند
  
        <small><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
        </svg>
      </small> 
    </a>


  <select name="" id="">
    <option value=""></option>
  </select>
</div>

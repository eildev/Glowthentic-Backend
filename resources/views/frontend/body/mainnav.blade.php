<!-- header-search -->
@include('frontend.body.headerSearch')
<!-- header-search-end -->

<!-- header-cart-start -->
@include('frontend.body.cartArea')
<!-- header-cart-end -->

<!-- mobile-menu-area -->
@include('frontend.body.tabMenu')
<!-- mobile-menu-area-end -->

<!-- sidebar-menu-area -->
@include('frontend.body.sidebar')

<script>
    let items = document.querySelectorAll('.sub_cat a').forEach((item)=>{
        item.addEventListener("mouseover",()=>{
            let submenuUl = item.nextElementSibling;
            if(submenuUl.style.display == "block"){
                submenuUl.style.display = "none";
            }else{
                submenuUl.style.display = "block";
            }
        })
    })
    $(document).on("mouseleave",'.subsubmenuUl', function(){
        $('.subsubmenuUl').css({'display':"none"});
    });
    $(document).ready(function() {
        $('#sub_cat li').each(function() {
            if ($(this).find('ul li').length > 0) {
                $(this).prepend("+");
            }
        });
    })
</script>
<!-- sidebar-menu-area-end -->

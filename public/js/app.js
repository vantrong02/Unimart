$(document).ready(function(){

    $(".dropdown-toggle").hover(function() {
        $(".dropdown-menu").toggle();
    })
    //================ CART =================//

    $(".num_order").change(function(){
        var id = $(this).attr("data-id");
        var qty = $(this).val();
        var data = {id: id, qty: qty}
        console.log(data);    
        $.ajax({
            url: 'http://localhost/laravelpro/unimart/cart/update',
            method: 'POST',
            data: JSON.stringify(data),
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'json',
            success: function(data){
                $("#sub_total-" + id).text(data.sub_total);
                $("#total-price span").text(data.total);
                $('span#num').text(data.num_order);
                $('p.desc span').text(data.num_order);
            },
            error: function (xhr, ajaxOption, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    //================ END CART =================//

    //================  FILTER PRICE =================//

    $(".common_selector-price").click(function() {
        var product_id = $("#category_save").val();
        var price = $(this).attr("data-price");
        var data = {product_id: product_id, price: price};
        console.log(data);
        $.ajax({
            url: 'http://localhost/laravelpro/unimart/product/get_price',
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'text',
            success: function(data) {
                $(".list-product").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

    var selectElement = document.getElementById("common_selector");
    selectElement.addEventListener("change", function() {
        var selectedValue = this.value;
        var product_id = $("#category_save").val();
        var data = {product_id: product_id, selectedValue: selectedValue};
        console.log(data);
        // Thực hiện các hành động khác dựa trên giá trị đã chọn
        $.ajax({
            url: 'http://localhost/laravelpro/unimart/product/get_price_order_by',
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'text',
            success: function(data) {
                $(".list-product").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
      });

    //================  END FILTER PRICE =================//

    //================  SEARCH =================//
    $("#search_name").keyup(function(){
        var action = "search";
        var search_name = $('#search_name').val();
        var product_id = $("#category_save").val();
        console.log(action, search_name, product_id);
        if($("#search_name").val() != ''){
            $.ajax({
                url: 'http://localhost/laravelpro/unimart/get_search',
                method: 'POST',
                data: {action: action, search_name: search_name, product_id: product_id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'text',
                success: function(data){
                    $(".list-product").html(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }else{
            $(".list-product").html(data);
        }
    });

    //================  END SEARCH =================//

    //================  SLIDE PRODUCT =================//

    $("#list-thumb .thumb-item").mouseenter(function(){
        var picture_src = $(this).find('img').attr('src');
        console.log(picture_src);
        $("#main-thumb img").attr('src', picture_src);
        $("#list-thumb .thumb-item").removeClass('active');
        $(this).addClass("active");
    });

    //================ END SLIDE PRODUCT =================//

    // =========================FORM==========================//
    $('.header__navbar-item--icon:nth-child(3)').click(function () {
        $('.login-box').stop().fadeIn();
        $('#header').removeClass('header-opacity');
        $('.header__overlay-user').stop().fadeToggle(600);
        var scrollsimple = $(window).scrollTop() + "px";
        $('body,html').stop().animate({ scrollTop: scrollsimple }, 800);
    });

    $('.content__comment-send span a').click(function () {
        $('.login-box').stop().fadeIn();
        $('#header').removeClass('header-opacity');
        $('.header__overlay-user').stop().fadeToggle(600);
    });

    $('.header__overlay-user').click(function () {
        $('.login-box').stop().fadeOut();
        $('.header__overlay-user').stop().fadeOut(600);
    });
    // =========================END-FORM=====================//
    

});


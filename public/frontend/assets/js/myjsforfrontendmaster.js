
// add wishlist 
const add_whishlist = document.querySelectorAll('.add_whishlist');
// console.log(add_whishlist);
add_whishlist.forEach(element => {
    // console.log(element)
    element.addEventListener('click', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let product_id = this.getAttribute('value');
        // alert(product_id);
        $.ajax({
            url: '/wishlist/add',
            type: 'POST',
            data: {
                'product_id': product_id,
            },
            success: function (response) {
                if (response.status == 200) {
                    toastr.success(response.message);
                    element.querySelector('i').setAttribute('style', 'color:red');
                    // console.log(element.querySelector('i'));
                } else if (response.status == 500) {
                    toastr.warning("Remove from wishlist");
                    element.querySelector('i').removeAttribute('style', 'color:red');
                }
            }
        });
    })
});



// add to cart 
const addForm = document.querySelectorAll('#add_to_cart_form');
addForm.forEach(element => {
    element.addEventListener('submit', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let product_id = this.elements.product_id.value;
        let variant_id = this.elements.variant_id.value;
        let selling_price = this.elements.selling_price.value;
        let weight = this.elements.weight.value;
        let unit = this.elements.unit.value;
        // console.log(product_id, variant_id,selling_price);
        $.ajax({
            url: '/product/add_to_cart',
            type: 'POST',
            data: {
                'product_id': product_id,
                'variant_id': variant_id,
                'selling_price': selling_price,
                'pr_quantity': '1',
                'weight': weight,
                'unit': unit
            },
            success: function (response) {
                if (response.status == 200) {
                    toastr.success(response.message);
                    showCart();
                } else {

                }
            }
        });

    });
})



// update cart 
function updateCartDisplay(cartData) {
    $('.cart_container').empty();
    // console.log(cartData);
    if (Object.keys(cartData).length > 0) {
        var itemsToDisplay = 3;
        // console.log(Object.keys(cartData).length);
        $('.cart_quantity').text(Object.keys(cartData).length);
        $('.mobile_show_quantity').text(Object.keys(cartData).length);

        for (var i = 0; i < itemsToDisplay; i++) {
            var key = Object.keys(cartData)[i];
            var item = cartData[key];

            $('.cart_container').append(
                '<li>' +
                '<div class="tpcart__item">' +
                '<div class="tpcart__img">' +
                '<img src="{{ asset('uploads / products / ') }}/' + item.options.image + '" alt="product Image">' +
                '<div class="tpcart__del">' +
                '<a href="#" class="item_remove" value="' + item.rowId + '"><i class="icon-x-circle"></i></a>' +
                '</div>' +
                '</div>' +
                '<div class="tpcart__content">' +
                '<span class="tpcart__content-title"><a href="#">' + item.name + '</a></span>' +
                '<div class="tpcart__cart-price">' +
                '<span class="quantity">' + item.qty + '</span> x ' +
                '<span class="new-price">৳' + item.price + '</span>' +
                '</div>' +
                '</div>' +
                '</div>' +
            '</li>'
            );
        }


        if (Object.keys(cartData).length > 3) {
            var remainingItems = Object.keys(cartData).length - itemsToDisplay;
            $('.cart_container').append('<li>and ' + remainingItems + ' more item(s)</li>');
        }
    } else {
        // Display a message when the cart is empty
        $('.cart_container').append('<p>Your cart is empty</p>');

        // Update the cart quantity span to 0 when the cart is empty
        $('.cart_quantity').text('0');
        $('.mobile_show_quantity').text('0');
    }

}



// Function to show data on cart
function showCart() {
    $.ajax({
        url: '/product/show_cart',
        type: "GET",
        dataType: 'JSON',
        success: function (res) {
            if (res.status == 200) {
                let totalPrice = 0;
                $.each(res.cartData, function (key, val) {
                    totalPrice += val.subtotal;
                });
                document.querySelector(".heilight-price").textContent = "৳" + totalPrice;
                updateCartDisplay(res.cartData);
                // console.log(res.cartData);
            }
        }
    });
}




$(document).ready(function () {
    // item remove from cart
    $(document).on('click', '.item_remove', function (e) {
        e.preventDefault();
        // alert('ok')
        let itemValue = this.getAttribute('value');
        // alert(itemValue);
        $.ajax({
            url: '/product/remove_cart_product/' + itemValue,
            type: "GET",
            success: function (res) {
                toastr.success(res.message);
                showCart();
            }
        })
    })

    // show cart 
    showCart();

    // sweet alert delete function
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();

        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Deleted!',
                    'Your File has been deleted.',
                    'success'
                )
            }
        })

    });
});




// search by suggestion
const top_search = document.querySelector('.top_search');
const top_search_list = document.querySelector('.top_search_list');
top_search.addEventListener('keyup', function (e) {
    let search_value = this.value;
    if (search_value) {
        $.ajax({
            url: '/product/global/search/' + search_value,
            type: "GET",
            success: function (res) {
                if (res.products) {
                    $('.top_search_list').css('display', 'block');
                    let data = "";
                    $.each(res.products, function (key, val) {
                        data += '<li>' + val.product_name + '</li>';
                    });
                    $('.top_search_list').html(data);
                }
            }
        })


    } else {
        $('.top_search_list').css('display', 'none');
    }
});

$(document).on('click', '.top_search_list li', function () {
    $('.top_search').val($(this).text());
    $('.top_search_list').css('display', 'none');
});




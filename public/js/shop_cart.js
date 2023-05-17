!
function(e) {
	"use strict";
	var o = {
		initialised: !1,
		init: function() {
			this.initialised || (this.initialised = !0, this.initShop(), this.addToCart(), this.productsCartDropDown())
		},
        initShop: function(){
            if(!localStorage.getItem('shopp_cart') )
            {
                localStorage.setItem('shopp_cart', JSON.stringify([]))
            }
        },
        addToCart: function()
		{
			let contex = this
			e(".add-cart").click(function(t) {

				let array = localStorage.getItem('shopp_cart');
				array = JSON.parse(array);

				let item = jQuery(this).data('product');
				let cant = 1;
				if (item.cantidad) { 
					cant = item.cantidad;
				} 
				item.cantidad = cant;
				item.subtotal = (parseFloat(item.sale_unit_price)*parseInt(item.cantidad)).toFixed(2);
				item.exchange_rate_sale = null;

				let found = array.find( x=> x.id == item.id);
				if(!found)
				{
					//array.push( jQuery(this).data('product') );
					array.push( item );
					localStorage.setItem('shopp_cart', JSON.stringify( array ) );
					contex.productsCartDropDown();
					contex.successAddProduct();
					contex.calculateTotalCart();

					/*$('#product_added').html(`
						<h1 class="product-title">${item.name}</h1>
						<div class="price-box">
							<span class="product-price">S/ ${ Number(item.sale_unit_price).toFixed(2) }</span>
						</div>
						<div class="product-desc">
							<p> ${item.description}  </p>
						</div>	`);

					$('#product_added_image').html( `<img src="/storage/uploads/items/${item.image_medium}" class="img" alt="product">`)*/
				}
				else{
					contex.alreadyProductCart();
				}
				
			})
		},
        productsCartDropDown: function()
		{
			//clean cart dropdown
			jQuery(".cart_list").empty();
			jQuery(".cart_count").empty();
			let count = 0;
			//get data local syrogare prodicts
			let array = localStorage.getItem('shopp_cart');
			array = JSON.parse(array)
			count = array.length;

			array.forEach(element => {
				let img_small = `${my_url_config}/storage/uploads/items/${element.image_small}`;
				if (element.image_small === 'imagen-no-disponible.jpg') {
					img_small = `${my_url_app}/no_disponible.webp`;
				}
				jQuery(".cart_list").append(`
						<li>
							<a href="javascript:void(0)" class="item_remove" onclick="remove(${element.id})"><i class="ion-close"></i></a>
							<a href="javascript:void(0)"><img src="${img_small}" alt="product">${element.description}</a>
							<span class="cart_quantity"> ${element.cantidad} x <span class="cart_amount"> <span class="price_symbole">S/</span></span>${Number(element.sale_unit_price).toFixed(2)}</span>
						</li>`
					);
			});
			jQuery(".cart_count").append(count);
		},
        calculateTotalCart: function()
		{
			let array = localStorage.getItem('shopp_cart');
			array = JSON.parse(array);
			let total = 0;
			array.forEach(element => {
				total += parseFloat(element.subtotal);
			});
	
			$(".cart_total_price").empty();
			$(".cart_total_price").append(total.toFixed(2));
		},
		successAddProduct: function()
		{
			toastr_msg('success', 'Bien !!', 'El Producto se agrego al carrito.');
			//jQuery('#moda-succes-add-product').modal('show');
		},
		alreadyProductCart: function()
		{
			toastr_msg('error', 'Error !!', 'El producto ya se encuentra agregado al carrito.');
			//jQuery('#modal-already-product').modal('show');
		},
    };
    jQuery(document).ready(function() {
		o.init()
	})
}(jQuery);


function agregue_cart(data)
{
	let errors = 0;
	let array = localStorage.getItem('shopp_cart');
	array = JSON.parse(array);
	
	let item = data;
	item.exchange_rate_sale = null;

	let found = array.find( x=> x.id == item.id);
	if(found){
		toastr_msg('error', 'Error !!', 'El producto ya se encuentra agregado al carrito.');
		return;
	}
	
	array.push( item );
	localStorage.setItem('shopp_cart', JSON.stringify( array ) );
	populate();
	calculatetotal();
	toastr_msg('success', 'Bien !!', 'El Producto se agrego al carrito.');
}
function remove(id)
{
	let array = localStorage.getItem('shopp_cart');
	array = JSON.parse(array);
	let indexFound = array.findIndex( x=> x.id == id)
	array.splice(indexFound, 1);
	localStorage.setItem('shopp_cart', JSON.stringify( array ) );
	populate();
	calculatetotal();
}

function calculatetotal()
{
	let array = localStorage.getItem('shopp_cart');
	array = JSON.parse(array);
	let total = 0;
	array.forEach(element => {
		total += parseFloat(element.subtotal)
	});

	$(".cart_total_price").empty();
	$(".cart_total_price").append(total.toFixed(2));
}

function populate()
{
	//clean cart dropdown
	$(".cart_list").empty();
	$(".cart_count").empty();
	let count = 0;
	//get data local syrogare prodicts
	let array = localStorage.getItem('shopp_cart');
	array = JSON.parse(array)
	count = array.length;

	array.forEach(element => {
		let img_small = `${my_url_config}/storage/uploads/items/${element.image_small}`;
		if (element.image_small === 'imagen-no-disponible.jpg') {
			img_small = `${my_url_app}/no_disponible.webp`;
		}
		jQuery(".cart_list").append(`
				<li>
					<a href="javascript:void(0)" class="item_remove" onclick="remove(${element.id})"><i class="ion-close"></i></a>
					<a href="javascript:void(0)"><img src="${img_small}" alt="product">${element.description}</a>
					<span class="cart_quantity"> ${element.cantidad} x <span class="cart_amount"> <span class="price_symbole">S/</span></span>${Number(element.sale_unit_price).toFixed(2)}</span>
				</li>`
			);
	});

	$(".cart_count").append(count);
}

function toastr_msg(action, title, message) {
	switch (action) {
		case 'success':
			toastr.success(message, title, {
				positionClass: "toast-bottom-left",
				timeOut: 5e3,
				closeButton: !0,
				debug: !1,
				newestOnTop: !0,
				progressBar: !1,
				preventDuplicates: !0,
				onclick: null,
				showDuration: "300",
				hideDuration: "500",
				extendedTimeOut: "1000",
				showEasing: "swing",
				hideEasing: "linear",
				showMethod: "fadeIn",
				hideMethod: "fadeOut",
				tapToDismiss: !1
			});
			break;

		case 'error':
			toastr.error(message, title, {
				positionClass: "toast-bottom-left",
				timeOut: 5e3,
				closeButton: !0,
				debug: !1,
				newestOnTop: !0,
				progressBar: !1,
				preventDuplicates: !0,
				onclick: null,
				showDuration: "300",
				hideDuration: "500",
				extendedTimeOut: "1000",
				showEasing: "swing",
				hideEasing: "linear",
				showMethod: "fadeIn",
				hideMethod: "fadeOut",
				tapToDismiss: !1
			});
			break;
	
		default:
			toastr.warning(message, title, {
				positionClass: "toast-bottom-left",
				timeOut: 5e3,
				closeButton: !0,
				debug: !1,
				newestOnTop: !0,
				progressBar: !1,
				preventDuplicates: !0,
				onclick: null,
				showDuration: "300",
				hideDuration: "500",
				extendedTimeOut: "1000",
				showEasing: "swing",
				hideEasing: "linear",
				showMethod: "fadeIn",
				hideMethod: "fadeOut",
				tapToDismiss: !1
			});
			break;
	}
}
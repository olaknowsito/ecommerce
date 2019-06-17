function computeTotal(){

		let total = 0;

		document.querySelectorAll('.subtotal').forEach(function(td_subtotal){
			total += parseFloat(td_subtotal.innerText);
		})

		document.querySelector('#total').innerText = total;

}

if(document.querySelector('#register')){
document.querySelector('#register').addEventListener('click', function() {
	let username = document.querySelector('#username').value;
	let password = document.querySelector('#password').value;
	let confirm = document.querySelector('#confirm').value;
	let firstname = document.querySelector('#firstname').value;
	let lastname = document.querySelector('#lastname').value;
	let email = document.querySelector('#email').value;
	let address = document.querySelector('#address').value;

	$.ajax({
		url: "../controllers/validate.php",
		type: "POST",
		data: {
			"username": username,
			"password": password,
			"confirm": confirm,
			"firstname": firstname,
			"lastname": lastname,
			"email": email,
			"address": address
		},
		success: function (response) {
			let parsedResponse = JSON.parse(response);

			if(parsedResponse.result == 'success') {
				document.querySelector('#register_form').submit();
				console.log('success');
			} else {
				console.log('failed');

				let error_container = document.querySelector('#error_container');

				error_container.innerHTML = '';
				parsedResponse.errors.forEach(function(error){
					error_container.innerHTML += `<div class="alert alert-danger" role="alert">
					${error}
					</div>`
				});
			}
		}
	});

});
};

document.querySelectorAll('.add-to-cart').forEach(function(cart_button){
	cart_button.addEventListener('click', function(){
		let item_id =this.dataset.id;
		let quantity = this.previousElementSibling.value;

		console.log(`item_id: ${item_id}`);
		console.log(`quantity:${quantity}`);	

		$.ajax({

			url:"../controllers/add_cart_item_endpoint.php",
			type: "POST",
			data: {

				"item_id": item_id,
				"quantity": quantity
			},
			success:function(count){
							document.querySelector('#cart_count').innerText = count;
			}
		})
	});
});



document.querySelectorAll('.subtract-quantity').forEach(function(decrease_button){

	decrease_button.addEventListener('click', function(){
		let item_id = this.dataset.id;
		let quantity =  -1;
		let _this = this;

		$.ajax({

			url: "../controllers/add_cart_item_endpoint.php",
			type: "POST",
			data: {
				"item_id": item_id,
				"quantity": quantity
			},
			success: function(count){
				document.querySelector('#cart_count').innerText = count;
				let span_quantity =_this.nextElementSibling
				let new_quantity =  parseInt(span_quantity.innerText) + quantity;

				span_quantity.innerText = new_quantity;

				if(new_quantity == 1){

					_this.disabled = true;
				}

				let td_quantity = _this.parentElement;
				let price = parseFloat(td_quantity.previousElementSibling.innerText);



				let new_subtotal = price*new_quantity;

				td_quantity.nextElementSibling.innerText = new_subtotal;
				computeTotal();
			} 

		});

	});



});

document.querySelectorAll('.add-quantity').forEach(function(increase_button){

	increase_button.addEventListener('click', function(){
		let item_id = this.dataset.id;
		let quantity =  1;
		let _this = this;

		$.ajax({

			url: "../controllers/add_cart_item_endpoint.php",
			type: "POST",
			data: {
				"item_id": item_id,
				"quantity": quantity
			},
			success: function(count){
				document.querySelector('#cart_count').innerText = count;
				let span_quantity =_this.previousElementSibling
				let new_quantity =  parseInt(span_quantity.innerText) + quantity;

				span_quantity.innerText = new_quantity;

				if(new_quantity > 1){

					span_quantity.previousElementSibling.disabled = false;
				}

				let td_quantity = _this.parentElement;
				let price = parseFloat(td_quantity.previousElementSibling.innerText);


				let new_subtotal = price*new_quantity;

				td_quantity.nextElementSibling.innerText = new_subtotal;
				computeTotal();
			} 
		});
	});
});

function readURL(input) {

  if (input.files && input.files[0]) {
    let reader = new FileReader();

    reader.onload = function(e) {
      $('#preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("[name='image']").change(function() {
  readURL(this);
});
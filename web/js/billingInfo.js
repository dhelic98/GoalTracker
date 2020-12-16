
var stripe = Stripe('pk_test_gEDbOlZxoBPguShhoV1f4tq3');


var elements = stripe.elements();


var style = {
  base: {
    // Add your base input styles here. For example:
    fontSize: '18px',
    color: "#566270",
  }
};


console.log(stripe);


var card = elements.create('card',{style: style});


card.mount('#card-element');

console.log(card);

card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});


function generate(){
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      
     sendToServer(result);
    }
  });

}


function sendToServer(result) {
  $.ajax({
    url: document.location.href,
    data: { token: result.token.id },
    type: 'post',
    dataType: 'json',
    success: function(res)
    {
        console.log(res);
    }
});

}

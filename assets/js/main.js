// bind all our listeners to DOM
$(document).on("submit", "form.js-register", function(event) {
  event.preventDefault();

  var form = $(this);
  var error = $('.js-error', form);
  var dataObject = {
    email: $("input[type='email']", form).val(),
    password: $("input[type='password']", form).val(),
  }

  // validation
  if (dataObject.email.length < 6) {
    error.text("Please enter a valid email address").show();
    return false;
  } else if (dataObject.password.length < 11) {
    error.text("Please enter a passphrase that is at least 11 characters long").show();
    return false
  }

  error.hide(); // hide error text when password length is more than 11

  // ajax
  $.ajax({
    type: 'POST',
    url: './ajax/register.php',
    data: dataObject,
    dataType: 'json',
    async: true
  })
  .done((data) => {
    console.log(data)
    if (data.redirect !== undefined) {
      window.location = data.redirect;
    }

    alert(data.name);
  })
  .fail((e) => {
    console.log(e)
  })
  .always((data) => {
    console.log(data)
  })

  return false;
})
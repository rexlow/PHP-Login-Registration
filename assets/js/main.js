// bind all our listeners to DOM
$(document).on("submit", "form.js-register", function(event) {
  event.preventDefault();

  var form = $(this);
  var error = $('.js-error', form);
  var data = {
    email: $("input[type='email']", form).val(),
    password: $("input[type='password']", form).val(),
  }

  // validation
  if (data.email.length < 6) {
    error.text("Please enter a valid email address").show();
    return false;
  } else if (data.password.length < 11) {
    error.text("Please enter a passphrase that is at least 11 characters long").show();
    return false
  }

  // ajax
  error.hide(); // hide error text when password length is more than 11

  return false;
})
// bind all our listeners to DOM
$(document).on("submit", "form.js-register, form.js-login", function(event) {
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
  } else if (dataObject.password.length < 8) {
    error.text("Please enter a passphrase that is at least 8 characters long").show();
    return false
  }

  error.hide(); // hide error text when password length is more than 8

  // ajax
  $.ajax({
      type: 'POST',
      url: (form.hasClass("js-login") ? './ajax/login.php' : './ajax/register.php'),
      data: dataObject,
      dataType: 'json',
      async: true
    })
    .done((data) => {
      if (data.redirect !== undefined) {
        window.location = data.redirect;
      } else if (data.error !== undefined) {
        error.text(data.error).show();
      }
    })
    .fail((e) => {
      console.log(e)
    })
    .always((data) => {
      console.log(data)
    })

  return false;
});
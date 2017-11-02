// bind all our listeners to DOM
$(document).on("submit", "form.js-register", function(event) {
  event.preventDefault();

  var form = $(this);
  var data = {
    email: $("input[type='email']", form).val(),
    password: $("input[type='password']", form).val(),
  }

  console.log(data);

  return false;
})
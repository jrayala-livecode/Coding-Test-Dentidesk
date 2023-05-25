function sendForm(event) {
    event.preventDefault();

    var emailInput = $('#email');
    var passwordInput = $('#password');

    var formData = {
        email: emailInput.val(),
        password: passwordInput.val()
    };

    $.ajax({
        url: '/api/login',
        type: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify(formData),
        success: function (response) {
            var token = response.token;

            localStorage.setItem('token', token);

            // Store the token in localStorage or cookies for authentication
            // Redirect to the dashboard or any other desired page
            showModal('Success', 'Login exitoso, redirigiendo al Dashboard');
            
            setTimeout(function() {
                window.location.href = '/transactions';
            }
            , 1000)
        },
        error: function (xhr, status, error) {
            var errors = xhr.responseJSON.errors;
            var errorMessage = '';

            $.each(errors, function (key, value) {
                errorMessage += value[0] + '\n';
            });

            showModal('Error', errorMessage);
        }
    });
}

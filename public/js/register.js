function sendForm(event) {
    event.preventDefault();

    var formData = {
        name: $('#name').val(),
        email: $('#email').val(),
        password: $('#password').val(),
        password_confirmation: $('#password_confirmation').val(),
    };

    $.ajax({
        url: '/api/register',
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function (response) {
            // Registration successful
            showModal('Success', 'Registro exitoso, redirigiendo al Login');
            
            setTimeout(function() {
                window.location.href = '/login';
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
// Function to check authentication status
document.addEventListener('DOMContentLoaded', function () {

    var token = localStorage.getItem('token');

    $.ajaxSetup({
        headers: {
          'Authorization': 'Bearer ' + token
        },
    });

    function checkAuthentication() {

        $.ajax({
            url: 'api/check-auth',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function (response) {
                $('#login-button').hide();
                $('#register-button').hide();
                console.log(response);
            },
            error: function (xhr) {
                console.log(xhr);
                $('#login-button').show();
                $('#register-button').show();
                $('#logout-button').hide();
                $('#transaction-button').hide();
                if(window.location.pathname !== '/login' && window.location.pathname !== '/register') {
                    window.location.href = '/login';
                }
            }
        });
        

    }

    checkAuthentication();
});


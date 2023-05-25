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
                // User is authenticated    
            },
            error: function (xhr) {
                window.location.href = '/login';
            }
        });
    }

    // Check authentication status on page load
    if(window.location.pathname !== '/login' && window.location.pathname !== '/register') {
        checkAuthentication();
    }
});


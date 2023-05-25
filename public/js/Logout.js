const Logout = {
    logout() {
        $.ajax({
            url: '/api/logout',
            type: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            success: function (response) {
                localStorage.removeItem('token');
                
                showModal('Success', 'Logged out.');

                setTimeout(function(){
                    window.location.href = '/login';
                }, 1000)
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseJSON.message || 'An error occurred';
    
                showModal('Error', errorMessage);
            }
        });
    }
}
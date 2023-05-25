var token = localStorage.getItem('token');

$.ajaxSetup({
  headers: {
    'Authorization': 'Bearer ' + token
  }
});

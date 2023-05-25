const Income = {
    index() {

        let dateData = {}

        if(UI.getYearAndMonth()){
            dateData = UI.getYearAndMonth();
        }

        $.ajax({
            url: '/api/incomes',
            type: 'GET',
            contentType: 'application/json',
            dataType: 'json',
            data: dateData,
            success: function (response) {
                console.log(response)
                UI.populateUI($('#income-body'), response, 'income')
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
    },
    async show(id) {
        return $.ajax({
            url: '/api/incomes/'+ id,
            type: 'get',
            contentType: 'application/json',
            dataType: 'json',
            success: function (expense) {
                return expense;
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseJSON.message || 'An error occurred';
    
                showModal('Error', errorMessage);
            }
        });
    },
    create(e) {
        e.preventDefault();

        const formData = formToJSON($('#ingresos-form'));
        
        if($('#ingresos-id').val() != ''){
            Income.update();
            return;
        }

        $.ajax({
            url: '/api/incomes',
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: "application/json; charset=utf-8",
            success: function (expense) {
                // Clear the form fields
                $('#description1').val('');
                $('#amount1').val('');
    
                Income.index();
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseJSON.message || 'An error occurred';
    
                showModal('Error', errorMessage);
            }
        });
    },
    update() {
        const formData = formToJSON($('#ingresos-form'));
        
        $.ajax({
            url: '/api/incomes/'+ $('#ingresos-id').val(),
            type: 'PUT',
            contentType: 'application/json',
            dataType: 'json',
            data: formData,
            success: function (expense) {
                // Clear the form fields
                $('#description1').val('');
                $('#amount1').val('');
    
                // Log the created expense to the console
                showModal('Edición Exitosa', 'Ingreso actualizado correctamente.'); 

                Income.index();
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseJSON.message || 'An error occurred';
    
                showModal('Error', errorMessage);
            }
        });

        UI.unsetUpdateTrigger('income');
    },
    delete(resourceId) {
        $.ajax({
            url: '/api/incomes/' + resourceId,
            type: 'DELETE',
            success: function () {
                Income.index();
            },
            error: function () {
                
            }
        });
    },
}
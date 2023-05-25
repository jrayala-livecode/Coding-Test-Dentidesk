const Expense = {
    index() {

        let dateData = {}

        if(UI.getYearAndMonth()){
            dateData = UI.getYearAndMonth();
        }
        

        $.ajax({
            url: '/api/expenses',
            type: 'GET',
            contentType: 'application/json',
            dataType: 'json',
            data: dateData,
            success: function (response) {
                console.log(response)
                UI.populateUI($('#expense-body'), response, 'expense')
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
            url: '/api/expenses/'+ id,
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

        const formData = formToJSON($('#egresos-form'));

        if($('#egresos-id').val() != ''){
            Expense.update();
            return;
        }

        $.ajax({
            url: '/api/expenses',
            type: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: formData,
            success: function (expense) {
                // Clear the form fields
                $('#description1').val('');
                $('#amount1').val('');
    
                // Log the created expense to the console
                console.log(expense);

                Expense.index();
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseJSON.message || 'An error occurred';
    
                showModal('Error', errorMessage);
            }
        });
    },
    update() {

        const formData = formToJSON($('#egresos-form'));
        
        $.ajax({
            url: '/api/expenses/'+ $('#egresos-id').val(),
            type: 'PUT',
            contentType: 'application/json',
            dataType: 'json',
            data: formData,
            success: function (expense) {
                // Clear the form fields
                $('#description1').val('');
                $('#amount1').val('');
    
                // Log the created expense to the console
                showModal('Edición Exitosa', 'Gasto actualizado correctamente.');
                Expense.index();
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseJSON.message || 'An error occurred';
    
                showModal('Error', errorMessage);
            }
        });

        UI.unsetUpdateTrigger('expense');

    },
    delete(resourceId) {
        $.ajax({
            url: '/api/expenses/' + resourceId,
            type: 'DELETE',
            success: function () {
                Expense.index()
            },
        });
    }
};
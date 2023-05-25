const Expense = {
    index() {
        $.ajax({
            url: '/api/expenses',
            type: 'GET',
            contentType: 'application/json',
            dataType: 'json',
            success: function (response) {
                console.log(response)
                Table.populateTable($('#expense-body'), response, 'expense')
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
    create(e) {
        e.preventDefault();

        const formData = formToJSON($('#egresos-form'));

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

const Income = {
    index() {
        $.ajax({
            url: '/api/incomes',
            type: 'GET',
            contentType: 'application/json',
            dataType: 'json',
            success: function (response) {
                console.log(response)
                Table.populateTable($('#income-body'), response, 'income')
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
    create(e) {
        e.preventDefault();

        const formData = formToJSON($('#ingresos-form'));
        
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
    show() {

    }
}

const Table = {
    populateTable(tableBody, response, type) {
        var tbody = tableBody;

        // Clear the existing table rows
        tbody.empty();

        // Iterate over the response data and generate table rows
        response.forEach(function (resource) {
            // Create a new row element
            var row = $('<tr>');
            // Create and append the table cells
            $('<td>').text(resource.category.name).appendTo(row);
            $('<td>').text(resource.description).appendTo(row);
            $('<td>').text(resource.amount).appendTo(row);
            $('<td>').html(`
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-info btn-sm">Editar</button>
                <button type="button" class="btn btn-danger btn-sm delete-${type}" data-id="${resource.id}">Eliminar</button>
            </div>
            `).appendTo(row);

            // Append the row to the table body
            tbody.append(row);
        });
        Table.addEventListeners()
    },
    addEventListeners() {
        $('.delete-expense').on('click', function () {
            
            let resourceId = this.dataset.id;
            
            // Perform the delete action using AJAX
            Expense.delete(resourceId);
        });
    
        $('.delete-income').on('click', function () {

            var resourceId = this.dataset.id;
            
            // Perform the delete action using AJAX
            Income.delete(resourceId);
        });
    }
}

// Call the Expense.index() function when the page is ready
document.addEventListener('DOMContentLoaded', () => {
    Expense.index();
    Income.index();

    $('#ingresos-form').submit(function (e) {
        Income.create(e);
    });

    $('#egresos-form').submit(function (e) {
        Expense.create(e);
    });
});





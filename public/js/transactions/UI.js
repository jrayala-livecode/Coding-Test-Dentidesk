const UI = {
    populateUI(UIBody, response, type) {
        var tbody = UIBody;

        // Clear the existing UI rows
        tbody.empty();

        // Iterate over the response data and generate UI rows
        response.forEach(function (resource) {
            // Create a new row element
            var row = $('<tr>');
            // Create and append the UI cells
            $('<td>').text(resource.category.name).appendTo(row);
            $('<td>').text(resource.description).appendTo(row);
            $('<td>').text(resource.amount).appendTo(row);
            $('<td>').text(resource.created_at).appendTo(row);
            $('<td>').html(`
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-info btn-sm" onclick="UI.setUpdateTrigger('${type}', ${resource.id})">Editar</button>
                <button type="button" class="btn btn-danger btn-sm delete-${type}" data-id="${resource.id}">Eliminar</button>
            </div>
            `).appendTo(row);

            // Append the row to the UI body
            tbody.append(row);
        });
        UI.addEventListeners()

        UI.displayIncomeAndExpensesByCategory();
        UI.displayTotals();
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
    },

    setUpdateTrigger(type, value) { 
        $('#ingresos-id').val('');
        $('#egresos-id').val('');

        if(type == 'income') {
            $('#ingresos-id').val(value);
            $('#ingresos-btn').text('Editar');
            $('#cancelar-ingresos-btn').show();
            
            this.setIncomeForEdition();
        }
        
        if(type == 'expense') {
            $('#egresos-id').val(value);
            $('#egresos-btn').text('Editar');
            $('#cancelar-egresos-btn').show();
            this.setExpenseForEdition();
        }
    },
    unsetUpdateTrigger(type) {
        if(type == 'income') {
            $('#ingresos-btn').text('Enviar');
            $('#cancelar-ingresos-btn').hide();
        }
        if(type == 'expense') {
            $('#egresos-btn').text('Enviar');
            $('#cancelar-egresos-btn').hide();
            this.unsetExpenseFields();
        }
    },
    async setExpenseForEdition() {
        let expense = await Expense.show($('#egresos-id').val());
        $('#category2').val(expense.category_id);
        $('#description2').val(expense.description);
        $('#amount2').val(expense.amount);
    },
    unsetExpenseFields(){
        $('#egresos-id').val('');
        $('#category2').val(1);
        $('#description2').val('');
        $('#amount2').val('');
    },
    async setIncomeForEdition() {
        let income = await Income.show($('#ingresos-id').val());        
        $('#category1').val(income.category_id);
        $('#description1').val(income.description);
        $('#amount1').val(income.amount);

    },
    unsetIncomeFields(){
        $('#ingresos-id').val('');
        $('#category1').val(1);
        $('#description1').val('');
        $('#amount1').val('');
    },
    getYearAndMonth() {
        let dateArray = $('#start').val().split('-');

        let monthAndYear = {
            'year' : dateArray[0],
            'month' : dateArray[1]
        }

        if(!monthAndYear.year || !monthAndYear.month){
            return false;
        }

        return monthAndYear;
    },
    async displayTotals() {
        let monthlyTotal = await Totals.monthlyTotal();

        console.log(monthlyTotal);

        $('#total-total').text(monthlyTotal.total);
        $('#total-income').text(monthlyTotal.totalIncome);
        $('#total-expense').text(monthlyTotal.totalExpense);
    },
    async displayIncomeAndExpensesByCategory() {
        let categoryTotal = await Totals.getIncomeAndExpensesByCategory();

        let incomeByCategory = categoryTotal.income_by_category;
        let expenseByCategory = categoryTotal.expenses_by_category;

        $('#income-category-table-body').empty();
        $('#expenses-category-table-body').empty();

        incomeByCategory.forEach(function (category) {
            // Create a new row element
            var row = $('<tr>');
            // Create and append the UI cells
            $('<td>').text(category.category).appendTo(row);
            $('<td>').text(category.total_amount).appendTo(row);
            // Append the row to the UI body
            $('#income-category-table-body').append(row);
        });

        expenseByCategory.forEach(function (category) {
            // Create a new row element
            var row = $('<tr>');
            // Create and append the UI cells
            $('<td>').text(category.category).appendTo(row);
            $('<td>').text(category.total_amount).appendTo(row);
            // Append the row to the UI body
            $('#expenses-category-table-body').append(row);
        });
        

    }
}
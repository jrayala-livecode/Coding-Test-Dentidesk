// Call the Expense.index() function when the page is ready
document.addEventListener('DOMContentLoaded', () => {
    $('#ingresos-form').submit(function (e) {
        Income.create(e);
    });

    $('#egresos-form').submit(function (e) {
        Expense.create(e);
    });

    $('#cancelar-egresos-btn').click(function() {
        UI.unsetExpenseFields();
    })

    $('#cancelar-ingresos-btn').click(function() {
        UI.unsetIncomeFields();
    })

    $('#start').change(function(){
        Expense.index();
        Income.index();

        UI.displayIncomeAndExpensesByCategory();
        UI.displayTotals();
    })
});

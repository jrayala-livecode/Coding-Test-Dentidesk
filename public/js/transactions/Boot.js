
document.addEventListener('DOMContentLoaded', () => {
    $('#cancelar-ingresos-btn').hide();
    $('#cancelar-egresos-btn').hide();

    $('#start').val(today())

    Expense.index();
    Income.index();
})

const Totals = {
    async monthlyTotal() {
        let dateData = {}

        if(UI.getYearAndMonth()){
            dateData = UI.getYearAndMonth();
        }
        
        return $.ajax({
            url: '/api/monthly-total',
            type: 'GET',
            contentType: 'application/json',
            dataType: 'json',
            data: dateData,
            success: function (response) {
                return response;
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
    async getIncomeAndExpensesByCategory() {
        let dateData = {}

        if(UI.getYearAndMonth()){
            dateData = UI.getYearAndMonth();
        }
        
        return $.ajax({
            url: '/api/get-income-expenses-category',
            type: 'GET',
            contentType: 'application/json',
            dataType: 'json',
            data: dateData,
            success: function (response) {
                return response;
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
}
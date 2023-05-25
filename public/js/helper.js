function formToJSON(form) {
    const formArray = form.serializeArray();

    // Convert the form array to a JSON object
    const formData = {};
    $(formArray).each(function (index, field) {
        formData[field.name] = field.value;
    });

    return JSON.stringify(formData);
}

function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}

function today(){
    var d = new Date();
    return [
        d.getFullYear(),
        padTo2Digits(d.getMonth() + 1),
    ].join('-');
}
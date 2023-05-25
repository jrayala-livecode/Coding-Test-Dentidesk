function formToJSON(form) {
    const formArray = form.serializeArray();

    // Convert the form array to a JSON object
    const formData = {};
    $(formArray).each(function (index, field) {
        formData[field.name] = field.value;
    });

    return JSON.stringify(formData);
}
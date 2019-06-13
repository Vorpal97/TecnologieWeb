function doValidation(id, actionUrl, formName) {

	function showErrors(resp) {
		$("#" + id).parent().parent().find('.errors').html(' '); //azzera la colonna errore
		$("#" + id).parent().parent().find('.errors').html(getErrorHtml(resp[id])); //e iniettiamo i nuovi che derivano dalla getError
	}

	$.ajax({
		type : 'POST',
		url : actionUrl,
		data : $("#" + formName).serialize(), //serialize è un metoto jq che fa una submit fittizia dei dati della form 
		dataType : 'json',
		success : showErrors //quando il dato con gli errori torna dal server iniettera solo i messaggi di errore dell'elemento di cui abbiamo appena attivato la change
	});
}

function getErrorHtml(formErrors) {
	if (( typeof (formErrors) === 'undefined') || (formErrors.length < 1))
		return;

	var out = '<ul>';
	for (errorKey in formErrors) {
		out += '<li>' + formErrors[errorKey] + '</li>';
	}
	out += '</ul>';
	return out;
}

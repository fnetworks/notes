async function prompt(msg) {
	return new Promise(resolve => {
		bootbox.prompt({
			title: msg,
			callback: resolve
		});
	});
}

async function ask(title, msg) {
	return new Promise(resolve => {
		bootbox.confirm({
			title: title,
			message: msg,
			callback: resolve
		});
	});
}

async function choose(title, options) {
	return new Promise(resolve => {
		bootbox.prompt({
			title: title,
			inputType: 'select',
			inputOptions: options,
			callback: resolve
		})
	});
}

const showSuccessMessage = msg => showMessage(msg, "success");
const showWarningMessage = msg => showMessage(msg, "warning");
const showErrorMessage   = msg => showMessage(msg, "danger");

function showMessage(msg, type = 'info', delay = 2000) {
	$.notify({
		message: msg
	}, {
		type: type,
		animate: {
			enter: 'animated bounceInDown',
			exit: 'animated bounceOutUp'
		},
		offset: 4,
		mouse_over: 'pause',
		delay: delay
	});
}
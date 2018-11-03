import swal from "sweetalert2";

class Notification {
	constructor() {
		this.id = "flash";
	}
	success(message, title = "Success") {
		return this.make(message, title);
	}
	error(message, title = "Oops") {
		return this.make(message, title, "error");
	}
	confirm(text, title = "Are you sure?") {
		return new Promise(resolve => {
			swal({
				confirmButtonText: "Okay",
				cancelButtonText: "No, cancel!",
				confirmButtonClass: "btn btn-primary",
				cancelButtonClass: "btn btn-danger",
				buttonsStyling: false,
				text,
				title,
				type: "question",
				showCancelButton: true
			})
				.then(result => {
					result.value ? resolve() : null;
				})
				.catch(canceled => null);
		});
	}
	make(text, title, type = "success") {
		return swal({
			confirmButtonClass: "btn btn-primary",
			buttonsStyling: false,
			text,
			title,
			type
		});
	}
}

window.Notify = new Notification();

window.Swal = Swal

const toastAlert = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        customClass: {
            confirmButton: "btn btn-link waves-effect waves-light",
            cancelButton: "btn btn-link btn-danger waves-effect waves-light"
        },
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    const Toast_5000 = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    function swalConfirm(fields,callback) {
        const {value:accept}=  Swal.fire({
            title: `The ${fields} have been modified, it is necessary to reload the window to reflect the changes.`,
            icon: "question",
            iconHtml: "?",
            confirmButtonText: "Reload ?",
            cancelButtonText: "Cancel",
            showCancelButton: true,
            showCloseButton: true,
            customClass: {
                confirmButton: "btn btn-link waves-effect waves-light",
                cancelButton: "btn btn-link btn-danger waves-effect waves-light"
            },
            confirmButtonColor:"#2e7d32",
            iconColor:"#2e7d32"
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                window.location.reload()
            }
        })
    }
    function swalConfirmCallback(title,confBtnText,callback) {
        const {value:accept}=  Swal.fire({
            title: `${title}`,
            icon: "question",
            iconHtml: "?",
            confirmButtonText: confBtnText,
            cancelButtonText: "Cancel",
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor:"#2e7d32",
            iconColor:"#2e7d32"
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                callback()
            }
        })
    }


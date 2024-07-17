const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
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
function swalConfirm(fields) {
    const {value:accept}=  Swal.fire({
        title: `The ${fields} have been modified, it is necessary to reload the window to reflect the changes.`,
        icon: "question",
        iconHtml: "?",
        confirmButtonText: "Reload ?",
        cancelButtonText: "Cancel",
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor:"#2e7d32",
        iconColor:"#2e7d32"
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            window.location.reload()
        }
    })
}

// initialize modal for detail service data
// let modalDetails =  document.getElementById('largeModal')
// M.Modal.init(modalDetails)
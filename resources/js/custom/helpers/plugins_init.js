import Swal from "sweetalert2";
const toastAlert = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        iconColor:"#1A56DB",
        timer: 3000,
        customClass: {
            confirmButton: "text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2",
            cancelButton: "text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
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
                confirmButton: "text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2",
                cancelButton: "text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
            },
            confirmButtonColor:"#1A56DB",
            iconColor:"#1A56DB"
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
            confirmButtonColor:"#1A56DB",
            iconColor:"#1A56DB"
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                callback()
            }
        })
    }

export {toastAlert,Toast_5000,swalConfirm,swalConfirmCallback}
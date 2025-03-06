console.log('teste')

// export default class Notification {
//     init(id = '', time = 500, message, options = {}) {
//         const toastContainer = document.getElementById(id);
//         const toast = document.createElement("div");
//         toast.className = "toast align-items-center text-bg-dark border-0 show";
//         toast.role = "alert";
//         toast.ariaLive = "assertive";
//         toast.ariaAtomic = "true";
//
//         toast.innerHTML = `
//                 <div class="d-flex mt-2">
//                     <div class="toast-body">
//                         ${message}
//                     </div>
//                     <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
//                 </div>
//             `;
//
//         toastContainer.appendChild(toast);
//         const bsToast = new bootstrap.Toast(toast);
//         bsToast.show();
//         setTimeout(() => {
//             toast.remove();
//         }, time);
//     }
// }
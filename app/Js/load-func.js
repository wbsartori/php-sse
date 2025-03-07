function loadBootstrap() {
    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css";
    document.head.appendChild(link);

    const script = document.createElement("script");
    script.src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js";
    script.onload = () => {
        console.log("Bootstrap carregado com sucesso!");
    };
    document.body.appendChild(script);
}

function notification(id = '', time = 500, message, options = {}) {
    const toastContainer = document.getElementById(id);
    const toast = document.createElement("div");
    toast.className = "toast align-items-center text-bg-dark border-0 show";
    toast.role = "alert";
    toast.ariaLive = "assertive";
    toast.ariaAtomic = "true";

    toast.innerHTML = `
                <div class="d-flex mt-2">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;

    toastContainer.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    setTimeout(() => {
        toast.remove();
    }, time);
}

function progressBar(id, time, options = {}) {
    document.getElementById(id).innerHTML = '';
    const progressWrapper = document.createElement("div");
    progressWrapper.className = "progress mt-3";

    const progressBar = document.createElement("div");
    progressBar.className = "progress-bar progress-bar-striped progress-bar-animated";
    progressBar.style.width = "0%";
    progressBar.setAttribute("role", "progressbar");
    progressBar.setAttribute("aria-valuemin", "0");
    progressBar.setAttribute("aria-valuemax", "100");

    progressWrapper.appendChild(progressBar);
    document.getElementById(id).appendChild(progressWrapper);

    let progress = 0;
    const interval = setInterval(() => {
        progress += 10;
        progressBar.style.width = progress + "%";
        progressBar.setAttribute("aria-valuenow", progress);

        if (progress >= 100) {
            clearInterval(interval);
        }
    }, time);
}
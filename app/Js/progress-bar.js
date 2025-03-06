export default class ProgressBar {
    init (id, time, options = {}){
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
}

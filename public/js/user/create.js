let imgUploadBtn = document.getElementById("img-upload");
let imgPreview = document.getElementById("img-preview");

imgPreview.style.display = "none";

imgUploadBtn.addEventListener("change", function () {
    try {
        let file = URL.createObjectURL(imgUploadBtn.files[0]);
        if (file) {
            imgPreview.style.display = "block";
            imgPreview.src = file;
        }
    } catch (error) {}
});
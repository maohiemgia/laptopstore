const deleteFormConfirm = document.getElementById("delete-form-confirm");
const csrf = deleteFormConfirm.querySelector('[name="_token"]').value;
const method = deleteFormConfirm.querySelector('[name="_method"]').value;

function deleteConfirm(actUrl) {
    deleteFormConfirm.action = actUrl;
}

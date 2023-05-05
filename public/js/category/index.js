import { API_URL } from "../apiconfig.js";

const categories = document.querySelector("#category");
const tableDisplayDetail = document.querySelector("#table-display-detail");
const tableDisplayDetailDeleted = document.querySelector(
    "#table-display-detail-deleted"
);

const deleteForm = document.getElementById("delete-form");
const deleteFormConfirm = document.getElementById("delete-form-confirm");
const restoreForm = document.getElementById("restore-form");
const csrf = deleteForm.querySelector('[name="_token"]').value;
const method = deleteForm.querySelector('[name="_method"]').value;
const csrf_restore = restoreForm.querySelector('[name="_token"]').value;
const method_restore = restoreForm.querySelector('[name="_method"]').value;

let viewDetailBtns = document.querySelectorAll(".classviewdetail");

viewDetailBtns.forEach((ele) => {
    ele.addEventListener("click", function (eve) {
        var catename = eve.target.dataset.catename; // Extract info from data-* attributes

        let btnIdValue = eve.target.id.substring(
            eve.target.id.indexOf("id") + 2
        );

        tableDisplayDetail.innerHTML = "";
        tableDisplayDetailDeleted.innerHTML = "";

        return fetch(API_URL + "categories/" + btnIdValue)
            .then((response) => response.json())
            .then((data) => {
                if (data.length == 0) {
                    tableDisplayDetail.innerHTML = `<td colspan="4">Không có dữ liệu!</td>`;
                    tableDisplayDetailDeleted.innerHTML = `<td colspan="4">Không có dữ liệu!</td>`;

                    return;
                }

                let notDeleteIndex = 0;
                let deleteIndex = 0;

                data.forEach((subcate) => {
                    if (subcate.deleted_at == null) {
                        tableDisplayDetail.innerHTML += `
                              <tr>
                                   <td>${++notDeleteIndex}</td>
                                   <td class="text-success">${subcate.name}</td>
                                   <td class="text-muted">${catename}</td>
                                   <td>
                                        <a href="/subcategories/${
                                            subcate.id
                                        }" class="btn btn-warning text-white">Sửa</a>

                                        <button class="btn btn-danger" 
                                        onclick="deleteConfirm('/subcategories/${
                                            subcate.id
                                        }/delete')" 
                                        data-toggle="modal" 
                                        data-target="#deleteconfirmmodal">
                                            Xóa
                                        </button>
                                   </td>
                              </tr>
                     `;
                    } else {
                        tableDisplayDetailDeleted.innerHTML += `
                              <tr class="bg-secondary text-bold">
                                   <td>${++deleteIndex}</td>
                                   <td class="text-success">${subcate.name}</td>
                                   <td>${catename}</td>
                                   <td>
                                        <form action="/subcategories/${
                                            subcate.id
                                        }/restore" method="POST" class="d-inline">
                                             <input type="hidden" name="_token" value="${csrf_restore}">
                                             <input type="hidden" name="_method" value="${method_restore}">
                                             <button class="btn btn-danger" type="submit">Phục hồi</button>
                                        </form>
                                   </td>
                              </tr>
                     `;
                    }
                });

                if (deleteIndex < 1) {
                    tableDisplayDetailDeleted.innerHTML = `<td colspan="4">Không có dữ liệu!</td>`;
                }
            });
    });
});

function deleteConfirm(actUrl) {
    deleteFormConfirm.action = actUrl;
}

const categories = document.querySelector("#category");
const tableDisplayDetail = document.querySelector("#table-display-detail");

const deleteForm = document.getElementById("delete-form");
const csrf = deleteForm.querySelector('[name="_token"]').value;
const method = deleteForm.querySelector('[name="_method"]').value;

let viewDetailBtns = document.querySelectorAll(".classviewdetail");

viewDetailBtns.forEach((ele) => {
    ele.addEventListener("click", function (eve) {
        var catename = eve.target.dataset.catename; // Extract info from data-* attributes

        let btnIdValue = eve.target.id.substring(
            eve.target.id.indexOf("id") + 2
        );

        tableDisplayDetail.innerHTML = "";

        return fetch("http://127.0.0.1:8000/api/categories/" + btnIdValue)
            .then((response) => response.json())
            .then((data) => {
                if (data.length == 0) {
                    return (tableDisplayDetail.innerHTML = `<td colspan="4">Không có dữ liệu!</td>`);
                }
                data.forEach((subcate, index) => {
                    tableDisplayDetail.innerHTML += `
                         <tr>
                              <td>${index + 1}</td>
                              <td class="text-success">${subcate.name}</td>
                              <td class="text-muted">${catename}</td>
                              <td>
                                   <a href="/categories/sub/${
                                       subcate.id
                                   }" class="btn btn-warning text-white">Sửa</a>

                                   <form action="api/subcategories/${
                                       subcate.id
                                   }" method="POST" class="d-inline">
                                   <input type="hidden" name="_token" value="${csrf}">
                                   <input type="hidden" name="_method" value="${method}">
                                   <button class="btn btn-danger" type="submit">Xóa</button>
                               </form>
                              </td>
                         </tr>
                `;
                });
            });
    });
});

const tableDisplayDetail = document.querySelector("#table-display-detail");

let viewDetailBtns = document.querySelectorAll(".classviewdetail");

viewDetailBtns.forEach((ele) => {
    ele.addEventListener("click", function (eve) {
        let btnIdValue = eve.target.id.substring(
            eve.target.id.indexOf("id") + 2
        );

        tableDisplayDetail.innerHTML = "";

        return fetch("http://127.0.0.1:8000/api/users/" + btnIdValue)
            .then((response) => response.json())
            .then((data) => {
                if (data.length == 0) {
                    tableDisplayDetail.innerHTML = `<p>Không có dữ liệu!</p>`;

                    return;
                }
                tableDisplayDetail.innerHTML += `
                         <h5>Tên: ${data.name}</h5>
                         <h5>Email: ${data.email}</h5>
                         <h5>Số điện thoại: ${data.phone_number}</h5>
                         <h5>Avatar: <img class="img-fluid img-rounded" style="max-width: 200px"
                              src="${data.image}" alt="avatar">
                         </h5>
                         <h5>Địa chỉ: ${data.address}</h5>
                         <h5>Ngày sinh: ${data.birthday}</h5>
                         <h5>Tuổi: ${data.age}</h5>
                         <h5>Giới tính: ${data.gender}</h5>
                         <h5>Quyền hạn: ${data.role_name}</h5>
                         <h5>Tài khoản đã hoạt động: ${data.day_live.d} ngày, ${data.day_live.h} giờ</h5>
                     `;
            });
    });
});

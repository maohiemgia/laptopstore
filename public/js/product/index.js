const getData = () => {
    return fetch("http://127.0.0.1:8000/api/products").then((response) => {
        return response.json();
    });
};

let table = document.querySelector("#tableshow");
getData().then((data) => {
    table.innerHTML = "";
    data.forEach((item, index) => {
        table.innerHTML += `<tr class=" text-center">
        <td  scope="col">${index}</td>
        <td  scope="col">${item.name}</td>
        <td  scope="col">
            <img src="${item.image}" alt="product" class="img-fluid" style="width: 150px; height:150px">
        </td>
        <td  scope="col" style="width: 300px;">${item.description.slice(0, 150)} ...</td>
        <td  scope="col"><a href="/option?id=${
            item.id
        }" class="btn btn-info">Option</a></td>
        <td  scope="col"><button class="btn btn-info">
        Chi tiết
    </button></td>
        <td  scope="col"><a href="/products/${item.id}" class="btn btn-success">
        Sửa
       </a></td>
        <td  scope="col"><button type="button" class="delete btn btn-warning text-white" data-id="${
            item.id
        }">Xóa</button></td>
    </tr>`;
    });
    document.querySelectorAll(".delete").forEach((item) => {
        item.addEventListener("click", () => {
            console.log(item.dataset.id);
            url = `/products/${item.dataset.id}`;
            $.ajax({
                url: url,
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (res) {
                    console.log("ok");
                },
            });
            location.reload();
        });
    });
});

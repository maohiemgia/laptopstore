const getData = () => {
    return fetch('http://127.0.0.1:8000/api/vouchers').then((response) => {
        return response.json()
    })
}
let table = document.querySelector("#table");
let page = document.querySelector("#paginate");
function render(data){
    table.innerHTML = '';
    data.data.forEach((item, index) => {
        table.innerHTML +=
            `<tr class=" text-center">
        <td  scope="col">${index+1}</td>
        <th  scope="col">${item.name}</th>
        <th  scope="col">${item.value}</th>
        <th  scope="col">${item.require_money}</th>
        <th  scope="col">${item.quantity}</th>
        <th  scope="col">${item.count_use}</th>
        <th  scope="col">${item.date_expired}</th>
        <th  scope="col">${item.description.slice(0, 50)}...</th>
        <th  scope="col">${item.status == 1 ? 'Sử dụng' : 'Ngừng sử dụng'}</th>
        <td  scope="col"><a href="/vouchers/${item.id}" class="btn btn-success">
        Sửa
       </a></td>
        <td  scope="col"><button type="button" class="delete btn btn-warning text-white" data-id="${item.id}">Xóa</button></td>
    </tr>`
    }
    )
    document.querySelectorAll(".delete").forEach((item) => {
        item.addEventListener("click", () => {
            url = `/vouchers/${item.dataset.id}`;
            $.ajax({
                url: url,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    console.log(res);
                }
            })
            location.reload();
        })
    })
    data.links.forEach((item) => {
        page.innerHTML += `
            <li class="page-item">
                <a class="page-link" aria-label="Previous">
                <button aria-hidden="true" class="page" style="border: none; outline: none; background: #fff;">${item.label}</button>
                </a>
            </li>
        `
    })
    document.querySelectorAll(".page").forEach((item) => {
        item.addEventListener("click", () => {
            getData(item.textContent).then((data) => {
                render(data);
            });
        })
    })
}
getData().then((data) => {
    render(data);
});


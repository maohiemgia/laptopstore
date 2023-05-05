import { API_URL } from "../apiconfig.js";

const getData = (page) => {
    return fetch(API_URL + 'option?page=' + page).then((response) => {
        return response.json()
    })
}
function getID() {
    var url = location.search
    var id = new URLSearchParams(url);
    return id.get('id');
}
let table = document.querySelector("#table");
let page = document.querySelector("#paginate");
function render(res) {
    table.innerHTML = '';
    const id = getID();
    const data = res.data.filter((item) => item.product_id == id ? item : '');
    data.forEach((item, index) => {
        table.innerHTML +=
            `<tr class=" text-center">
        <td  scope="col">${index + 1}</td>
        <th  scope="col">${item.product.name}</th>
        <th  scope="col">${item.cpu}</th>
        <th  scope="col">${item.gpu}</th>
        <th  scope="col">${item.ram}</th>
        <th  scope="col">${item.memory}</th>
        <th  scope="col">${item.quantity}</th>
        <th  scope="col">${item.price} VND</th>
        <th  scope="col">${item.status == 1 ? 'Đang bán' : 'Ngừng kinh doanh'}</th>
        <td  scope="col"><button class="btn btn-info detail" data-id="${item.id}">
        Chi tiết
    </button></td>
        <td  scope="col"><a href="/option/${item.id}" class="btn btn-success">
        Sửa
       </a></td>
        <td  scope="col"><button type="button" class="delete btn btn-warning text-white" data-id="${item.id}">Xóa</button></td>
    </tr>`
    }
    )
    document.querySelectorAll(".delete").forEach((item) => {
        item.addEventListener("click", () => {
            if(confirm('Bạn có chắc chắn muốn xóa?')){
                url = `/option/${item.dataset.id}`;
            $.ajax({
                url: url,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    console.log('ok');
                }
            })
            location.reload();
            }
        })
    })
    document.querySelectorAll('.detail').forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('#detail').style.display = 'block';
            getDetail(item.dataset.id).then((data) => {
                console.log(data);
                detail.innerHTML = '';
                detail.innerHTML = `
                    <i class="fas fa-times" id="close"></i>
                    <h5 class="col-12">Name: ${data[0].product.name}</h5>
                    <h5 class="col-12">Description: ${data[0].cpu}</h5>
                    <h5 class="col-12">Category: ${data[0].gpu}</h5>
                    <h5 class="col-12">Total version: ${data[0].ram}</h5>
                    <h5 class="col-12">Total version: ${data[0].memory}</h5>
                    <h5 class="col-12">Total version: ${data[0].screen}</h5>
                    <h5 class="col-12">Total version: ${data[0].battery}</h5>
                    <h5 class="col-12">Total version: ${data[0].weight}</h5>
                    <h5 class="col-12">Total version: ${data[0].size}</h5>
                    <h5 class="col-12">Total version: ${data[0].price} VND</h5>
                    <h5 class="col-12">Total version: ${data[0].quantity}</h5>
                    `
                    document.querySelector("#close").addEventListener('click', () =>{
                        document.querySelector("#detail").style.display = 'none';
                    })    
            })
        })
    })
}
getData().then((res) => {   
    render(res);
    res.links.forEach((item) => {
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
});
const getDetail = (id) => {
    return fetch(API_URL+ 'option/' + id)
    .then((response) => response.json())
}

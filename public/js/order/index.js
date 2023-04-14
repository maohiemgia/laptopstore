const detail = document.querySelector("#detail");
const getData = () => {
    return fetch('http://127.0.0.1:8000/api/orders').then((response) =>{
        return response.json()
    })
}
function getID(){
    var url = location.search
    var id = new URLSearchParams(url);
    return id.get('id');
}
let table = document.querySelector("#table");
let page = document.querySelector("#paginate");
function render(data) {
    table.innerHTML = '';
    data.data.forEach((item, index) =>{
            table.innerHTML += 
        `<tr class=" text-center">
        <td  scope="col">${index+1}</td>
        <th  scope="col">${item.customer_name}</th>
        <th  scope="col">${item.customer_address}</th>
        <th  scope="col">${item.customer_phone_number}</th>
        <th  scope="col">${item.total_cost}</th>
        <th  scope="col">${item.discount_value}</th>
        <th  scope="col">${item.status == 0 ? 'Canceled' : (item.status == 1 ? 'Shipping' : 'Completed')}</th>
        <td  scope="col">
            <button class="btn btn-info detail" data-id="${item.id}">Chi tiết</button>
        </td>
        <td scope="col">
            <a href="/orders/${item.id}" class="btn btn-success"> Sửa</a>
        </td>
    </tr>`
        }
    )
    document.querySelectorAll('.detail').forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('#detail').style.display = 'block';
            getDetail(item.dataset.id).then((data) => {
                detail.innerHTML = '';
                detail.innerHTML = `
                    <i class="fas fa-times" id="close"></i>
                    <h5 class="col-6">Name: ${data[0].customer_name}</h5>
                    <h5 class="col-6">Email: ${data[0].customer_email}</h5>
                    <h5 class="col-6">Address: ${data[0].customer_address}</h5>
                    <h5 class="col-6">Phone number: ${data[0].customer_phone_number}</h5>
                    <h5 class="col-6">Tax: ${data[0].tax_fee}</h5>
                    <h5 class="col-6">Shipping fee: ${data[0].shipping_fee}</h5>
                    <h5 class="col-6">Payment method: ${data[0].payment_type}</h5>
                    <h5 class="col-6">Total: ${data[0].total_cost}</h5>
                    <h5 class="col-6">Discount: ${data[0].discount_value}</h5>
                    <h5 class="col-6">Status: ${data[0].status}</h5>
                    <h5 class="col-12">Note: ${data[0].note}</h5>`
                    for (let i = 0; i < data[0].detail.length; i++) {
                        detail.innerHTML +=
                        `
                            <h5 class="col-6">Product: ${data[0].detail[i].product_detail}</h5>
                            <h5 class="col-6">Quatity: ${data[0].detail[i].quantity}</h5>
                        `
                    }
                    document.querySelector("#close").addEventListener('click', () =>{
                        document.querySelector("#detail").style.display = 'none';
                    })    
            })
        })
    })
}
getData().then((data) =>{
    render(data);
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
});

const getDetail = (id) => {
    return fetch('http://127.0.0.1:8000/api/orders/' + id)
    .then((response) => response.json())
}
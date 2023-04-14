const getData = () => {
    return fetch('http://127.0.0.1:8000/api/option').then((response) =>{
        return response.json()
    })
}
function getID(){
    var url = location.search
    var id = new URLSearchParams(url);
    return id.get('id');
}
let table = document.querySelector("#table");
getData().then((data) =>{
    table.innerHTML = '';
    const id = getID();
    data.forEach((item, index) =>{
        if(item.product_id == id){
            table.innerHTML += 
        `<tr class=" text-center">
        <td  scope="col">${index+1}</td>
        <th  scope="col">${item.product.name}</th>
        <th  scope="col">${item.cpu}</th>
        <th  scope="col">${item.gpu}</th>
        <th  scope="col">${item.ram}</th>
        <th  scope="col">${item.memory}</th>
        <th  scope="col">${item.quantity}</th>
        <th  scope="col">${item.price} VND</th>
        <th  scope="col">${item.status == 1 ? 'Đang bán' : 'Ngừng kinh doanh'}</th>
        <td  scope="col"><button class="btn btn-info">
        Chi tiết
    </button></td>
        <td  scope="col"><a href="/option/${item.id}" class="btn btn-success">
        Sửa
       </a></td>
        <td  scope="col"><button type="button" class="delete btn btn-warning text-white" data-id="${item.id}">Xóa</button></td>
    </tr>`
        }
    })
document.querySelectorAll(".delete").forEach((item) => {
    item.addEventListener("click",() => {
        console.log(item.dataset.id);
        url = `/option/${item.dataset.id}`;
        $.ajax({
            url: url,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res){
                console.log('ok');
            }
        })
        location.reload();
    })
})
});


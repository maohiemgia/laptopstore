const detail = document.querySelector("#detail");
const getData = (page) => {
    return fetch("http://127.0.0.1:8000/api/products?page=" + page).then((response) => {
        return response.json();
    });
};

let table = document.querySelector("#tableshow");
let page = document.querySelector("#paginate");
function render(data){
    table.innerHTML = "";
    data.data.forEach((item, index) => {
        table.innerHTML += `<tr class=" text-center">
        <td  scope="col">${index+1}</td>
        <td  scope="col" style="width: 150px;">${item.name}</td>
        <td  scope="col">
            <img src="${item.image}" alt="product" class="img-fluid" style="width: 150px; height:150px">
        </td>
        <td  scope="col" style="width: 250px;">${item.description.slice(0, 100)} ...</td>
        <td  scope="col"><a href="/option?id=${
            item.id
        }" class="btn btn-info">Option</a></td>
        <td  scope="col"><button class="btn btn-info detail" data-id=${item.id}>
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
            if(confirm('Bạn có chắc chắn muốn xóa')){
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
            }
            
        });
    });

    document.querySelectorAll('.detail').forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('#detail').style.display = 'block';
            getDetail(item.dataset.id).then((data) => {
                detail.innerHTML = '';
                detail.innerHTML = `
                    <i class="fas fa-times" id="close"></i>
                    <h5 class="col-6">Name: ${data.name}</h5>
                    <h5 class="col-12">Description: ${data.description}</h5>
                    <h5 class="col-6">Category: ${data.category.name}</h5>
                    <h5 class="col-6">Total version: ${data.productoptions.length}</h5>
                    `
                    document.querySelector("#close").addEventListener('click', () =>{
                        document.querySelector("#detail").style.display = 'none';
                    })    
            })
        })
    })
}
getData().then((data) => {
    render(data)
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
    return fetch('http://127.0.0.1:8000/api/products/' + id)
    .then((response) => response.json())
}
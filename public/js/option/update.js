const categories = document.querySelector("#category");
const getId = () => {
    var url = window.location.href;
    var id = url.substring(url.lastIndexOf('/') + 1);
    return id;
}

const getProduct = () => {
    const id = getId();
    return fetch("http://127.0.0.1:8000/api/option/"+ id).then((response) => response.json())
    .then((data) => {
        document.querySelector("#name").value = data[0].product.name;
        document.querySelector("#id").value = data[0].product.id;
        document.querySelector("#cpu").value = data[0].cpu;
        document.querySelector("#gpu").value = data[0].gpu;
        document.querySelector("#ram").value = data[0].ram;
        document.querySelector("#memory").value = data[0].memory;
        document.querySelector("#quantity").value = data[0].quantity;
        document.querySelector("#price").value = data[0].price;
        document.querySelector("#status").value = data[0].status;
        document.querySelector("#battery").value = data[0].battery;
        document.querySelector("#size").value = data[0].size;
        document.querySelector("#weight").value = data[0].weight;
        document.querySelector("#back").innerHTML = `<a href="/option?id=${data[0].product_id}" class="text-white" >&larr; Quản lý phiên bản</a>`;
    })
}

getProduct();


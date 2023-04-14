const getId = () => {
    var url = window.location.href;
    var id = url.substring(url.lastIndexOf('/') + 1);
    return id;
}

const getVoucher = () => {
    const id = getId();
    return fetch("http://127.0.0.1:8000/api/vouchers/"+ id).then((response) => response.json())
    .then((data) => {
        document.querySelector("#name").value = data.name;
        document.querySelector("#value").value = data.value;
        document.querySelector("#require_money").value = data.require_money;
        document.querySelector("#quantity").value = data.quantity;
        document.querySelector("#date_expired").value = data.date_expired;
        document.querySelector("#description").innerHTML = data.description;
        document.querySelector("#status").value = data.status;
    })
}

getVoucher();

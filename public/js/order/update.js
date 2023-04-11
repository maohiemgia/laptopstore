const getId = () => {
    var url = window.location.href;
    var id = url.substring(url.lastIndexOf('/') + 1);
    return id;
}

const getOrder = () => {
    const id = getId();
    return fetch("http://127.0.0.1:8000/api/orders/"+ id).then((response) => response.json())
    .then((data) => {
        console.log(data[0].status);
        document.querySelector("#status").value = data[0].status;
    })
}

getOrder();


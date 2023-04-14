const name = document.querySelector("#name");
const getProduct = (id) => {
    return fetch("http://127.0.0.1:8000/api/products/" + id).then((response) =>
        response.json()
    );
};

function getID(){
    var url = location.search
    var id = new URLSearchParams(url);
    return id.get('id');
}

getProduct(getID()).then((data) => {
    name.value = data.name;
})


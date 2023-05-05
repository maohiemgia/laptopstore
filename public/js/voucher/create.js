import { API_URL } from "../apiconfig.js";

const name = document.querySelector("#name");
const getProduct = (id) => {
    return fetch(API_URL + "products/" + id).then((response) =>
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


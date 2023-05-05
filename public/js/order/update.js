import { API_URL } from "../apiconfig.js";

const getId = () => {
    var url = window.location.href;
    var id = url.substring(url.lastIndexOf("/") + 1);
    return id;
};

const getOrder = () => {
    const id = getId();
    return fetch(API_URL + "orders/" + id)
        .then((response) => response.json())
        .then((data) => {
            document.querySelector("#status").value = data[0].status;
        });
};

getOrder();

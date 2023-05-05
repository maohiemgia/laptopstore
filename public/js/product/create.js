import { API_URL } from "../apiconfig.js";

const categories = document.querySelector("#category");
const getCategories = () => {
    return fetch(API_URL + "categories").then((response) => response.json());
};

getCategories().then((data) => {
    categories.innerHTML = "";
    data.forEach((item) => {
        categories.innerHTML += `
        <option value="" hidden></option>
        <option value="${item.id}">${item.name}</option>
    `;
    });
});

categories.addEventListener("change", () => {
    subCategories.innerHTML = "";

    return fetch(API_URL + "categories/" + categories.value)
        .then((response) => response.json())
        .then((data) => {
            data.forEach((item) => {
                subCategories.innerHTML += `
            <option value="" hidden></option>
            <option value="${item.id}">${item.name}</option>
        `;
            });
        });
});

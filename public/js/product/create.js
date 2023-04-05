const categories = document.querySelector("#category");
const getCategories = () => {
    return fetch("http://127.0.0.1:8000/api/categories").then((response) =>
        response.json()
    );
};

const getProduct = () => {
    return fetch("http://127.0.0.1:8000/api/products").then((response) =>
        response.json()
    );
};

const postProduct = (data) => {
    return fetch("http://127.0.0.1:8000/api/products", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    }).then((response) => response.json());
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
    subCategories.innerHTML = '';

    return fetch("http://127.0.0.1:8000/api/categories/" + categories.value)
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

const submit = document.querySelector("#submit");
let names = document.querySelector("#name");
let subCategories = document.querySelector("#subCategories");
let desc = document.querySelector("#desc");

// submit.addEventListener("click", () => {
//     const name = names.value;
//     const sub_category_id = subCategories.value;
//     const description = desc.value;
//     let image = document.querySelector("#image").files[0];
//     const data = {
//         name,
//         sub_category_id,
//         description,
//         image,
//     };
//     postProduct(data).then(() => {});
// });

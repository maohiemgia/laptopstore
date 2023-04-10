const categories = document.querySelector("#category");
const getCategories = (id) => {
    return fetch("http://127.0.0.1:8000/api/categories").then((response) =>
        response.json()
    ).then((data) => {
        categories.innerHTML = "";
        data.forEach((item) => {
            categories.innerHTML += `
            <option value="" hidden></option>
            <option value="${item.id}" ${item.id == id ? "selected" : ''}>${item.name}</option>
        `;
        });
    });
};
const getId = () => {
    var url = window.location.href;
    var id = url.substring(url.lastIndexOf('/') + 1);
    return id;
}

const getSubCategories = (categoryId, subId) => {
    return fetch("http://127.0.0.1:8000/api/categories/" + categoryId)
        .then((response) => response.json())
        .then((data) => {
            data.forEach((item) => {
                subCategories.innerHTML += `
            <option value="" hidden></option>
            <option value="${item.id}" ${item.id == subId ? "selected" : ''}>${item.name}</option>
        `;
            });
        });
}

const getProduct = () => {
    const id = getId();
    return fetch("http://127.0.0.1:8000/api/products/"+ id).then((response) => response.json())
    .then((data) => {
        document.querySelector("#name").value = data.name;
        console.log(data.category_id);
        getCategories(data.category_id);
        getSubCategories(data.category_id, data.sub_category_id);
        document.querySelector("#desc").innerHTML = data.description;
    })
}

getProduct();

// getCategories().then((data) => {
//     categories.innerHTML = "";
//     data.forEach((item) => {
//         categories.innerHTML += `
//         <option value="" hidden></option>
//         <option value="${item.id}">${item.name}</option>
//     `;
//     });
// });

categories.addEventListener("change", () => {
    subCategories.innerHTML = '';

    getSubCategories(categories.value, '');
});

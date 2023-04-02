const categories = document.querySelector('#category');
const subCategories = document.querySelector('#subCategories');
const getCategories = () => {
    return fetch('http://127.0.0.1:8000/api/categories').then((response) => response.json())
}

const postProduct = async (data) => {
    await fetch('http://127.0.0.1:8000/api/products',{
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    })
}

getCategories().then((data) => {
    categories.innerHTML = '';
    data.forEach(item => {
        categories.innerHTML += `
        <option value="" hidden></option>
        <option value="${item.id}">${item.name}</option>
    `
    });
});

categories.addEventListener('change', () => {
    return fetch('http://127.0.0.1:8000/api/categories/'+categories.value)
    .then((response) => response.json())
    .then((data) => {
        console.log(data[0].sub);
        data[0].sub.forEach(item => {
            subCategories.innerHTML += `
            <option value="" hidden></option>
            <option value="${item.id}">${item.name}</option>
        `
    })
})})

const submit = document.querySelector('#submit');

submit.addEventListener('click', () => {
    let name = document.querySelector('#name');
    let subCategories = document.querySelector('#subCategories');
    let desc = document.querySelector('#desc');
    const data = {
        "name": name.value,
        "sub_category_id": subCategories.value,
        "description": desc.value
    }
    postProduct(data)
})


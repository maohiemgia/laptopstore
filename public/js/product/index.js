const getData = async () => {
    return fetch('http://127.0.0.1:8000/api/products').then((response) =>{
        return response.json()
    })
}
getData().then((data) =>{
    console.log(data);
});
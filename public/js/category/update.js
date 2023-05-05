import { API_URL } from "../apiconfig.js";

let divParentCate = document.getElementById("divParentCate");
let selectParentCate = document.getElementById("selectParentCate");

if (divParentCate != null) {
    selectParentCate.value = 0;
    selectParentCate.innerHTML = `<option value="">Loading. . .</option>`;

    window.addEventListener("load", function () {
        return fetch(API_URL + "categories")
            .then((response) => response.json())
            .then((data) => {
                selectParentCate.innerHTML = "";
                data.forEach((ele) => {
                    var option = document.createElement("option");
                    option.value = ele.id;
                    option.text = ele.name;
                    if (ele.id == selectParentCate.dataset.subcateid) {
                        option.selected = true;
                    }
                    selectParentCate.add(option);
                });
            });
    });
}

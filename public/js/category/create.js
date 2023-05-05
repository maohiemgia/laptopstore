import { API_URL } from "../apiconfig.js";

const hasParentBtn = document.getElementById("hascategoryparent");
let divParentCate = document.getElementById("divParentCate");
let selectParentCate = document.getElementById("selectParentCate");

divParentCate.style.display = "none";

hasParentBtn.addEventListener("click", function () {
    if (hasParentBtn.checked == true) {
        divParentCate.style.display = "block";

        selectParentCate.innerHTML = `<option value="">Loading. . .</option>`;

        return fetch(API_URL + "categories")
            .then((response) => response.json())
            .then((data) => {
                selectParentCate.innerHTML = "";
                data.forEach((ele) => {
                    var option = document.createElement("option");
                    option.value = ele.id;
                    option.text = ele.name;
                    selectParentCate.add(option);
                });
            });
    } else {
        selectParentCate.value = 0;
        divParentCate.style.display = "none";
    }
});

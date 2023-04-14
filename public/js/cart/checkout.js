let enterCouponField = document.querySelector("#enterCouponField");
let valuevoucher = document.querySelector("#valuevoucher");
let productCartDisplay = document.querySelector("#product-cart-detail-display");
let totalCostDisplay = document.querySelector("#totalTemp");
let totalCostAllDisplay = document.querySelector("#totalCost");
let discount_value = document.querySelector("#discount_value");
let total_cost = document.querySelector("#total_cost");
let cartLocalInfo = JSON.parse(localStorage.getItem("cart"));
let valuevouchernumber = 0;

if (cartLocalInfo == null) {
    location.href = "/product-list";
}

if (enterCouponField != undefined) {
    enterCouponField.style.display = "none";
}
if (valuevoucher != undefined) {
    displayVoucherValue();
}

function displayCouponField() {
    if (enterCouponField.style.display == "none") {
        enterCouponField.style.display = "flex";

        return;
    }

    enterCouponField.style.display = "none";
}

function displayVoucherValue() {
    let valuevoucherVND = new Intl.NumberFormat("vi-VN").format(
        Number(valuevoucher.innerText)
    );

    valuevouchernumber = valuevoucher.innerText;
    discount_value.value = valuevouchernumber;
    valuevoucher.innerText = "-" + valuevoucherVND;
}

let totalcostnotship = document.querySelector("#totalcostnotship");
let priceTemp = 0,
    totalCost = 0,
    totalcostall = 0;

cartLocalInfo.forEach((ele) => {
    totalCost = new Intl.NumberFormat("vi-VN").format(
        Number(ele.price - ele.discount_value) * Number(ele.cartquantity)
    );

    totalcostall +=
        Number(ele.price - ele.discount_value) * Number(ele.cartquantity);

    productCartDisplay.innerHTML += `
          <li>
               <a href="#" class="d-flex align-items-start justify-content-between">
                    ${ele.product_name} (Tùy chọn ${ele.optionindex}) (x${ele.cartquantity}) 
                    <span class="last d-block">${totalCost}</span>
               </a>
          </li>
     `;
});

total_cost.value = totalcostall;

totalcostallVnd = new Intl.NumberFormat("vi-VN").format(Number(totalcostall));
totalcostallHasShipVnd = new Intl.NumberFormat("vi-VN").format(
    Number(totalcostall) + 30000 - Number(valuevouchernumber)
);

totalCostDisplay.innerHTML = totalcostallVnd;
totalCostAllDisplay.innerHTML = totalcostallHasShipVnd;

// tạo cookie chứa dữ liệu giỏ hàng để xử lý bên laravel
let myProductOptions = localStorage.getItem("cart");
document.cookie = "productOptions=" + myProductOptions;
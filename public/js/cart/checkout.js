let enterCouponField = document.querySelector("#enterCouponField");
let productCartDisplay = document.querySelector("#product-cart-detail-display");
let totalCostDisplay = document.querySelector("#totalTemp");
let totalCostAllDisplay = document.querySelector("#totalCost");
let total_cost = document.querySelector("#total_cost");
let cartLocalInfo = JSON.parse(localStorage.getItem("cart"));

enterCouponField.style.display = "none";

function displayCouponField() {
    if (enterCouponField.style.display == "none") {
        enterCouponField.style.display = "flex";

        return;
    }

    enterCouponField.style.display = "none";
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
                    ${ele.product_name} (x${ele.cartquantity}) 
                    <span class="last d-block">${totalCost}</span>
               </a>
          </li>
     `;
});

total_cost.value = totalcostall;

totalcostallVnd = new Intl.NumberFormat("vi-VN").format(Number(totalcostall));
totalcostallHasShipVnd = new Intl.NumberFormat("vi-VN").format(
    Number(totalcostall) + 30000
);

totalCostDisplay.innerHTML = totalcostallVnd;
totalCostAllDisplay.innerHTML = totalcostallHasShipVnd;

// tạo cookie chứa dữ liệu giỏ hàng để xử lý bên laravel
let myProductOptions = localStorage.getItem("cart");
document.cookie = "productOptions=" + myProductOptions;

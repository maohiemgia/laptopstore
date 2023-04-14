let addtocartbtn = document.querySelector("#addtocartbtn");
let productoptions = document.querySelectorAll(".product-options");
let optioninfo = document.querySelector("#optioninfo");
let optionquantity = document.querySelector("#optionquantity");
let optionprice = document.querySelector("#optionprice");
let optionpricesale = document.querySelector("#optionsale");
let pricedisplay = document.querySelector("#pricedisplay");
let itemQuantity = document.querySelector("#itemQuantity");

if (productoptions && productoptions.length) {
    document.getElementById("quantityzerodisplay").style.display = "none";

    let productid = productoptions[0].dataset.productid;
    let productitem = {};
    let productName, productImage;
    let productFetch = fetch(
        "http://127.0.0.1:8000/api/product-detail/" + productid
    )
        .then((response) => response.json())
        .then((data) => {
            productName = data.name;
            productImage = data.image;

            return;
        });
    let dataProduct;
    let dataProductFetch = fetch(
        "http://127.0.0.1:8000/api/product-detail/" + productid
    )
        .then((response) => response.json())
        .then((data) => {
            dataProduct = data;
            productitem = dataProduct.productoptions[0];
            productitem.optionindex = productoptions[0].dataset.optionindex;

            productoptions[0].classList.add("active");
            productitem.cartquantity = itemQuantity.value;
            itemQuantity.setAttribute("max", productitem.quantity);
            if (productitem.quantity < 1) {
                optionquantity.innerText = "Hết hàng";
                document.getElementById("quantityzerodisplay").style.display =
                    "block";
                document.getElementById("additemdisplay").className +=
                    " hidden";
            }

            return;
        });

    productoptions.forEach((ele) => {
        ele.addEventListener("click", function (evt) {
            let optionid = evt.target.dataset.optionid;
            let optionindex = evt.target.dataset.optionindex;

            productoptions.forEach((ele) => {
                ele.classList.remove("active");
            });
            evt.target.classList.add("active");

            dataProduct.productoptions.forEach((optionitem) => {
                if (optionpricesale) {
                    optionpricesale.style.display = "none";
                }

                if (optionitem.id == optionid) {
                    productitem = optionitem;
                    productitem.optionindex = optionindex;
                    optionquantity.innerText = optionitem.quantity;
                    document.getElementById(
                        "quantityzerodisplay"
                    ).style.display = "none";
                    document
                        .getElementById("additemdisplay")
                        .classList.remove("hidden");

                    if (optionitem.quantity < 1) {
                        optionquantity.innerText = "Hết hàng";
                        document.getElementById(
                            "quantityzerodisplay"
                        ).style.display = "block";
                        document.getElementById("additemdisplay").className +=
                            " hidden";
                    }

                    pricedisplay.innerHTML =
                        `<span id="optionprice">` +
                        new Intl.NumberFormat("vi-VN").format(optionitem.price);
                    +`</span>`;

                    if (optionitem.discount_value > 0) {
                        optionpricesale.innerText =
                            "Đang Giảm " +
                            new Intl.NumberFormat("vi-VN").format(
                                optionitem.discount_value
                            ) +
                            " đ";

                        optionpricesale.style.display = "block";

                        pricedisplay.innerHTML =
                            `
                                   <span id="pricenow" class="pr-3">
                                   ` +
                            new Intl.NumberFormat("vi-VN").format(
                                optionitem.price - optionitem.discount_value
                            ) +
                            `
                                    đ  
                                    </span>
                                    <span id="optionprice" style="text-decoration: line-through">
                                    ` +
                            new Intl.NumberFormat("vi-VN").format(
                                optionitem.price
                            ) +
                            `
                                    đ
                                    </span>`;
                    }

                    optioninfo.innerHTML = `
                              <tr>
                                   <td>
                                   <h5>Màn hình</h5>
                                   </td>
                                   <td>
                                   <h5>${optionitem.screen}</h5>
                                   </td>
                              </tr>
                              <tr>
                                   <td>
                                   <h5>CPU</h5>
                                   </td>
                                   <td>
                                   <h5>${optionitem.cpu}</h5>
                                   </td>
                              </tr>
                              <tr>
                                   <td>
                                   <h5>GPU</h5>
                                   </td>
                                   <td>
                                   <h5>${optionitem.gpu}</h5>
                                   </td>
                              </tr>
                              <tr>
                                   <td>
                                   <h5>Ram</h5>
                                   </td>
                                   <td>
                                   <h5>${optionitem.ram}</h5>
                                   </td>
                              </tr>
                              <tr>
                                   <td>
                                   <h5>Bộ nhớ</h5>
                                   </td>
                                   <td>
                                   <h5>${optionitem.memory}</h5>
                                   </td>
                              </tr>
                              <tr>
                                   <td>
                                   <h5>Pin</h5>
                                   </td>
                                   <td>
                                   <h5>${optionitem.battery}</h5>
                                   </td>
                              </tr>
                              <tr>
                                   <td>
                                   <h5>Kích thước</h5>
                                   </td>
                                   <td>
                                   <h5>${optionitem.size}</h5>
                                   </td>
                              </tr>
                              <tr>
                                   <td>
                                   <h5>Trọng lượng</h5>
                                   </td>
                                   <td>
                                   <h5>${optionitem.weight}</h5>
                                   </td>
                              </tr>
                         `;

                    itemQuantity.setAttribute("max", optionitem.quantity);

                    return;
                }
            });
        });
    });

    // display add to cart notification
    window.addEventListener("DOMContentLoaded", function () {
        $(addtocartbtn).popover({
            content: "Thêm vào giỏ hàng thành công!",
            placement: "right",
            trigger: "click",
            container: "#addtocartbtn",
        });

        $(addtocartbtn).on("shown.bs.popover", function () {
            updateDisplayCartLengthFunc();

            setTimeout(function () {
                $(addtocartbtn).popover("hide");
            }, 2000);
        });
    });

    itemQuantity.addEventListener("change", function () {
        if (parseInt(itemQuantity.value) > parseInt(itemQuantity.max)) {
            productitem.cartquantity = parseInt(itemQuantity.max);
        }
        if (parseInt(itemQuantity.value) < parseInt(itemQuantity.min)) {
            productitem.cartquantity = parseInt(itemQuantity.min);
        }
    });

    addtocartbtn.addEventListener("click", function () {
        let localCart = JSON.parse(localStorage.getItem("cart"));
        productitem.cartquantity = itemQuantity.value;

        if (parseInt(itemQuantity.value) > parseInt(itemQuantity.max)) {
            productitem.cartquantity = parseInt(itemQuantity.max);
        }
        if (parseInt(itemQuantity.value) < parseInt(itemQuantity.min)) {
            productitem.cartquantity = parseInt(itemQuantity.min);
        }

        productitem.product_name = productName;
        productitem.product_image = productImage;

        if (localCart == null) {
            localStorage.setItem("cart", JSON.stringify([productitem]));
        } else {
            let checkMatchItem = 0;
            localCart.forEach((itemincart) => {
                if (itemincart.id == productitem.id) {
                    itemincart.cartquantity =
                        Number(productitem.cartquantity) +
                        Number(itemincart.cartquantity);

                    localStorage.setItem("cart", JSON.stringify(localCart));
                    checkMatchItem++;

                    return;
                }
            });
            if (checkMatchItem == 0) {
                localCart.push(productitem);
                localStorage.setItem("cart", JSON.stringify(localCart));
            }

            localCart = JSON.parse(localStorage.getItem("cart"));
        }

        updateDisplayCartLengthFunc();
    });
}

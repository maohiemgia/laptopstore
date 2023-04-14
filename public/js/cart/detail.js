renderCartDetail();

function renderCartDetail() {
    let cartLocalInfo = JSON.parse(localStorage.getItem("cart"));
    let cartDetailDisplay = document.querySelector("#cart-detail-display");
    let goCheckOut = document.querySelector("#gocheckout-section");
    let itemInCartArr = "";
    let priceTemp = 0,
        totalcostall = 0,
        totalCost = 0;

    goCheckOut.innerHTML =
        '<a class="btn_1 bg-success text-white" href="/product-list">Đi mua sắm</a>';

    if (cartLocalInfo != null) {
        cartLocalInfo.forEach((ele, index) => {
            priceTemp = new Intl.NumberFormat("vi-VN").format(
                ele.price - ele.discount_value
            );

            totalCost = new Intl.NumberFormat("vi-VN").format(
                Number(ele.price - ele.discount_value) *
                    Number(ele.cartquantity)
            );

            totalcostall +=
                Number(ele.price - ele.discount_value) *
                Number(ele.cartquantity);

            itemInCartArr += `
     <tr>
          <td>
               <div class="media">
                    <div class="d-flex">
                         <img src="${ele.product_image}" style="width: 200px;height: 150px;cursor:pointer;" alt="product" onclick="location.href='/product-detail/${ele.product_id}'" />
                    </div>
                    <div class="media-body w-100" style="max-width: 450px;height:100px;overflow:overlay;">
                         <p class="font-weight-bold" style="cursor:pointer;" onclick="location.href='/product-detail/${ele.product_id}'">
                            ${ele.product_name} (Tùy chọn ${ele.optionindex})
                         </p>
                         <p>CPU: ${ele.cpu}</p> 
                         <p>GPU: ${ele.gpu}</p> 
                         <p>RAM: ${ele.ram}</p> 
                         <p>Bộ Nhớ: ${ele.memory}</p> 
                    </div>
               </div>
          </td>
          <td class="px-0">
               <h5>
                    ${priceTemp}
               </h5>
          </td>
          <td>
               <div class="product_count">
                    <span class="input-number-decrement" data-toggle="popover" data-content="Tối thiểu 1" data-placement="top" data-container="#inputdisplay${index}" onclick="decItem(this)"> 
                         <i class="ti-angle-down"></i> 
                    </span>
                    <input class="input-number-display" type="number" value="${ele.cartquantity}" min="1"
                         max="${ele.quantity}" data-cartitemid="${ele.id}" id="inputdisplay${index}" onchange="updateCartItemQuantity(${ele.id}, this.value, this)">
                    <span class="input-number-increment" data-toggle="popover" data-content="Tối đa ${ele.quantity}" data-placement="top" data-container="#inputdisplay${index}" onclick="incItem(this)"> 
                         <i class="ti-angle-up"></i> 
                    </span>
               </div>
          </td>
          <td class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
               <h4>${totalCost}</h4>
               <button class="btn btn-danger mt-2" onclick="removeCartItem(this)" data-cartiddelete="${ele.id}">
                    <i class="fas fa-trash-alt"></i>
               </button>
          </td>
     </tr>
   `;
        });

        goCheckOut.innerHTML =
            '<a class="btn_1 mr-2 mb-2 mb-lg-0" href="/product-list">Tiếp tục mua sắm</a><a class="btn_1 bg-success text-white checkout_btn_1" href="/checkout">Đi thanh toán</a>';

        cartDetailDisplay.innerHTML = itemInCartArr;

        cartDetailDisplay.innerHTML += `<tr class="bottom_button">
        <td colspan="2">
        
                                             </td>
                                             <td colspan="2">
                                                  <div class="cupon_text float-right">
                                                  <a class="btn_1 bg-warning" style="cursor: pointer;" onclick="cartClear()">
                                                            Bỏ toàn bộ sản phẩm trong giỏ
                                                            </a>
                                                  </div>
                                                  </td>
                                                  </tr>
                                        <tr>
                                             <td></td>
                                             <td></td>
                                             <td>
                                             <h5 style="min-width: 150px;">Tổng tiền (vnđ)</h5>
                                             </td>
                                             <td class="px-0">
                                             <h3 class="font-weight-bold m-0" id="totalcostnotship">0</h3>
                                             </td>
                                             </tr>`;

        totalcostallVnd = new Intl.NumberFormat("vi-VN").format(
            Number(totalcostall)
        );

        let totalcostnotship = document.querySelector("#totalcostnotship");

        totalcostnotship.innerText = totalcostallVnd;
    } else {
        cartDetailDisplay.innerHTML =
            "<tr><td colspan='4' class='text-center'>Giỏ hàng hiện không có sản phẩm nào!</td></tr>";
    }
}

// increment quantity item cart
function incItem(element) {
    // Get the input element
    var input = element.parentNode.querySelector(".input-number-display");

    if (input.value - input.max < 0) {
        input.value = parseInt(input.value) + 1;
        $(element).popover("disable");
    } else {
        $(element).popover("enable");
        $(element).on("shown.bs.popover", function () {
            setTimeout(function () {
                $(element).popover("hide");
            }, 3000);
        });
    }

    updateCartItemQuantity(input.dataset.cartitemid, input.value, input);
}

// decrement quantity item cart
function decItem(element) {
    // Get the input element
    var input = element.parentNode.querySelector(".input-number-display");

    if (input.value - input.min > 0) {
        input.value = parseInt(input.value) - 1;
        $(element).popover("disable");
    } else {
        $(element).popover("enable");
        $(element).on("shown.bs.popover", function () {
            setTimeout(function () {
                $(element).popover("hide");
            }, 3000);
        });
    }

    updateCartItemQuantity(input.dataset.cartitemid, input.value, input);
}

// update quantity item cart
function updateCartItemQuantity(itemId, itemQuantity, element) {
    if (element) {
        if (Number.isNaN(element.value) || element.value % 1 != 0) {
            return;
        }
        if (element.value < 1) {
            element.value = 1;
        }
        if (parseFloat(element.value) > parseFloat(element.max)) {
            element.value = element.max;
        }

        itemQuantity = element.value;
    }

    let localCart = JSON.parse(localStorage.getItem("cart"));

    if (localCart != null) {
        localCart.forEach((itemincart) => {
            if (itemincart.id == itemId) {
                itemincart.cartquantity = itemQuantity;

                localStorage.setItem("cart", JSON.stringify(localCart));

                return;
            }
        });
    }
    renderCartDetail();
    updateDisplayCartLengthFunc();
}

// remove cart item
function removeCartItem(element) {
    let confirmDel = window.confirm("Xác nhận xóa");

    if (confirmDel) {
        let localCart = JSON.parse(localStorage.getItem("cart"));
        let cartIdDelete = element.dataset.cartiddelete;

        if (localCart != null && localCart.length > 1) {
            localCart.forEach((itemincart, index) => {
                if (itemincart.id == cartIdDelete) {
                    localCart.splice(index, 1);
                    localStorage.setItem("cart", JSON.stringify(localCart));

                    return;
                }
            });
        } else {
            localStorage.removeItem("cart");
        }

        displayAlert("Xóa thành công!");
        renderCartDetail();
        updateDisplayCartLengthFunc();
    }
}

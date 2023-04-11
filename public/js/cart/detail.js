let cartDetailDisplay = document.querySelector("#cart-detail-display");
let totalcostnotship = document.querySelector("#totalcostnotship");
let cartLocalInfo = JSON.parse(localStorage.getItem("cart"));
let itemInCartArr = "";
let priceTemp = 0,
    totalcostall = 0,
    totalCost = 0;

cartLocalInfo.forEach((ele) => {
    priceTemp = new Intl.NumberFormat("vi-VN").format(
        ele.price - ele.discount_value
    );

    totalCost = new Intl.NumberFormat("vi-VN").format(
        Number(ele.price - ele.discount_value) * Number(ele.cartquantity)
    );

    totalcostall +=
        Number(ele.price - ele.discount_value) * Number(ele.cartquantity);

    itemInCartArr += `
     <tr>
          <td>
               <div class="media">
                    <div class="d-flex">
                         <img src="${ele.product_image}" style="width: 130px;height: 120px;" alt="product" />
                    </div>
                    <div class="media-body w-100" style="max-width: 500px;height:100px;overflow:overlay;">
                         <p class="font-weight-bold">${ele.product_name} </p>
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
                    <span class="input-number-minus"> <i class="ti-angle-down"></i></span>
                    <input class="input-number" type="text" value="${ele.cartquantity}" min="1"
                         max="${ele.quantity}">
                    <span class="input-number-plus"> <i class="ti-angle-up"></i></span>
               </div>
          </td>
          <td>
               <h5>${totalCost}</h5>
          </td>
     </tr>
   `;
});

totalcostallVnd = new Intl.NumberFormat("vi-VN").format(Number(totalcostall));
totalcostnotship.innerText = totalcostallVnd;
cartDetailDisplay.innerHTML = itemInCartArr + cartDetailDisplay.innerHTML;

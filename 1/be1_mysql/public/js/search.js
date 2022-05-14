async function getProductSearch(productName) {
    //hiển thị
    const loader = document.querySelector(".loader");
    // loader.classList.remove('d-none');
    //bước 1 :url, data, fetch
    const url = "./app/api/getproductSearch.php";
    const data = { productName: productName };
    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset-utf-8",
            "Accept": "application/json; charset-utf-8"
        },
        body: JSON.stringify(data)

    });
    // bước 2 :đọc dữ liệu trả về

    const result = await response.json();
    //ẩn loader
    loader.classList.add('d-none');
    // bước 3 : Hiển thị giao diện
    const divResult = document.querySelector(".search-result");

    divResult.innerHTML = "";
    result.forEach(item => {
        let regex = new RegExp('(' + productName +')','gi');
        productNames = item.product_name.replace(regex,'<b>$1</b>');
        divResult.innerHTML += `
    <div style = "position: relative " class "search-product-name">
    <img src="./public/images/${item.product_photo}" style="height: 40px; width: 40px;"  alt="">
   ${productNames}
      
  </div>
  
  `;
    });
    // ${item.product_name}
    if (productName == "" || divResult.length == 0) {
        divResult.innerHTML = "";
    }






    // divResult.innerHTML= result.product_name;

}
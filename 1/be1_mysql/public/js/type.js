async function getProductTypecare(producttype)
{
    alert("hello");
    //hiển thị
    const loader = document.querySelector(".loader");
    loader.classList.remove('d-none');
    //bước 1 :url, data, fetch
 const url = "./app/api/getproductTypes.php";
 const data ={ producttype: producttype };
 const response = await fetch(url, {
     method: "POST",
     headers:{
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
 
 const divResult = document.querySelector("#result");
 

// divResult.innerHTML= result.product_name;
divResult.innerHTML = `
<h2>${result.product_name}</h2>
<div class="product-price"> ${result.product_price}</div>
<div class="imge"><img src="./public/images/${result.product_photo}" alt=""></div>
<div class="product-description"> ${result.product_description}</div>
`;




}
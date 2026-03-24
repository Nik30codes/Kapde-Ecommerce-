// SIZE SELECTION
document.querySelectorAll(".size-btn").forEach(btn=>{
btn.addEventListener("click",function(){

document.querySelectorAll(".size-btn")
.forEach(b=>b.classList.remove("active"))

this.classList.add("active")

})
})


// ADD TO CART WITH SIZE
document.querySelector(".add-cart-btn")?.addEventListener("click",function(){

let productId = this.dataset.id
let size = document.querySelector(".size-btn.active")

if(!size){
alert("Please select size")
return
}

size = size.innerText

window.location.href =
"/ecommerce/pages/add_to_cart.php?id="+productId+"&size="+size

})


// IMAGE HOVER ZOOM
let img = document.getElementById("main-image")

if(img){

img.addEventListener("mouseover",function(){
this.style.transform="scale(1.1)"
this.style.transition="transform 0.3s"
})

img.addEventListener("mouseout",function(){
this.style.transform="scale(1)"
})

}


// CART QUANTITY CONTROL
document.querySelectorAll(".plus").forEach(btn=>{
btn.addEventListener("click",function(){

let qty = this.parentElement.querySelector(".qty")
qty.innerText = parseInt(qty.innerText)+1

updateTotal()

})
})

document.querySelectorAll(".minus").forEach(btn=>{
btn.addEventListener("click",function(){

let qty = this.parentElement.querySelector(".qty")
let value = parseInt(qty.innerText)

if(value>1){
qty.innerText = value-1
}

updateTotal()

})
})


function updateTotal(){

let total = 0

document.querySelectorAll(".cart-item").forEach(item=>{

let price = parseInt(
item.querySelector(".price").innerText.replace("₹","")
)

let qty = parseInt(
item.querySelector(".qty").innerText
)

total += price * qty

})

document.getElementById("cart-total").innerText = total

}


// SEARCH PRODUCTS
let search = document.getElementById("search-input")

if(search){

search.addEventListener("keyup",function(){

let filter = this.value.toLowerCase()

document.querySelectorAll(".product-card")
.forEach(card=>{

let name = card.querySelector("h4").innerText.toLowerCase()

card.style.display =
name.includes(filter) ? "block" : "none"

})

})

}


// CATEGORY FILTER
document.querySelectorAll(".cat-btn").forEach(btn=>{

btn.addEventListener("click",function(){

let cat = this.dataset.cat

document.querySelectorAll(".product-card")
.forEach(card=>{

if(cat==="all" || card.dataset.category===cat){
card.style.display="block"
}else{
card.style.display="none"
}

})

})

})


// HERO SLIDER
let banners = [
"assets/images/banner1.jpg",
"assets/images/banner2.jpg",
"assets/images/banner3.jpg"
]

let index = 0
let hero = document.getElementById("hero-img")

if(hero){

setInterval(()=>{

index++

if(index>=banners.length){
index=0
}

hero.src=banners[index]

},3000)

}


// WISHLIST


document.addEventListener("click", function(e){

if(e.target.classList.contains("wishlist-btn")){

let btn = e.target;
let id = btn.dataset.id;

fetch("/ecommerce/pages/add_to_wishlist.php?id=" + id)
.then(res => res.text())
.then(data => {

data = data.trim();

console.log("Response:", data);

if(data === "added"){
btn.innerHTML = "❤️";
}
else if(data === "removed"){
btn.innerHTML = "♡";
}
else if(data === "login_required"){
window.location = "/ecommerce/pages/login.php";
}

});

}

});
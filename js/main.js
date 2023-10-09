
// script for making body dark on clicking search

function goDark() {
    let darkBody = document.querySelector(".dark-body")
    darkBody.removeAttribute("hidden")
}

function noDark() {
    let darkBody = document.querySelector(".dark-body")
    darkBody.setAttribute("hidden", null)
}

// Script for fading images

var slNum = 0;
function slideShow() {
    setTimeout(slideShow, 8000);
    var img = document.querySelectorAll(".slImg");
    for (let x = 0; x < img.length; x++) {
        img[x].style.opacity = "0";
    }
    slNum++;
    if (slNum > img.length) { slNum = 1 }
    if (img[slNum - 1]) {
        img[slNum - 1].style.opacity = "1";
    }
}
if (document.querySelectorAll(".slImg")) {
    slideShow();
}

// For showing less short description

function shortDesc() {

    let catDesc = document.querySelectorAll(".shortDesc")
    catDesc.forEach((element) => {
        let shortDesc = element.innerHTML.slice(0, 60) + "..."
        if (document.querySelector(".mtl-1")) {
            shortDesc = element.innerHTML.slice(0, 100) + "..."
        }
        element.innerHTML = shortDesc
    })
}
if (document.querySelector(".shortDesc")) {
    shortDesc()
}

// For showing more products 

if (document.querySelector(".btn-showMore")) {
    var seeMore = document.querySelector(".More")
    var seeLess = document.querySelector(".Less")
    var container = document.querySelector(".mainCategories")
    var containerChilds = container.children
    var containerChildCount = container.childElementCount

    var childs = []
    var removeChilds = []

    var num = 0

    if (container.innerHTML.trim() == "No products available right now") {
        seeMore.setAttribute("hidden", null)
    }
}

function showMore() {

    for (let i = num; i < num + 12; i++) {
        childs.push(containerChilds[i])
    }
    childs.forEach((element) => {
        if (element != undefined) {
            element.removeAttribute("hidden")
        }
    })
    if (num > 11) {
        seeLess.removeAttribute("hidden")
    }
    if (containerChildCount <= childs.length) {
        seeMore.setAttribute("hidden", null)
    }

    num += 12
}
if (document.querySelector(".btn-showMore") && containerChildCount > 0) {
    showMore()
}

function showLess() {
    let remNum = childs.length
    for (let x = remNum - 12; x < remNum; x++) {
        removeChilds.push(containerChilds[x])
    }
    removeChilds.forEach((element) => {
        if (element != undefined) {
            element.setAttribute("hidden", null)
        }
    })
    for (let y = 0; y < 12; y++) {
        childs.pop()
    }
    num -= 12
    if (num === 12) {
        seeLess.setAttribute("hidden", null)
    }
    seeMore.removeAttribute("hidden")

}

// script for sliding product images 
var imgNum = 2

var slide = "-19vw"
function slideLeft() {
    let width = window.innerWidth
    if (width < 1110) {
        slide = "-23vw"
    }
    if (width < 915) {
        slide = "-26vw"
    }
    if (width < 750) {
        slide = "-31vw"
    }
    if (width < 625) {
        slide = "-50vw"
    }
    if (width < 500) {
        slide = "-100vw"
    }
    let productImgs = document.querySelector(".productItem").children
    productImgs[imgNum - 1].style.transform = "translate(1vw,0vw)"
    productImgs[imgNum].removeAttribute("hidden")
    setTimeout(() => {
        productImgs[imgNum].style.transform = `translate(${slide}, 0vw)`
    })
    if (imgNum == 6) {
        productImgs[5].style.transform = "translate(1vw,0vw)"
        productImgs[1].removeAttribute("hidden")
        setTimeout(() => {

            productImgs[5].setAttribute("hidden", null)

        }, 600)
        imgNum = 1
        chkNum = 2
    }

    setTimeout(() => {
        if (imgNum != 1 && imgNum != 0) {
            productImgs[imgNum - 1].setAttribute("hidden", null)
        }
        imgNum++
    }, 600)

}

// function to handle cart actions 

function cart_action(pid, type, btn) {
    if (document.querySelector("#selQty")) {
        var quantity = document.querySelector("#selQty").value
    }
    data = {
        'pid': pid,
        'qty': quantity,
        'type': type
    }
    jsondata = JSON.stringify(data);

    fetch("handles/handle_cart.php", {
        method: "POST",
        body: jsondata,
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then((res) => res.text())
        .then((data) => {
            if (data == "notLogedIn") {
                window.location.href = "login.php"
            } else if (type == "add") {
                let cartNo = document.querySelectorAll(".cart-no")
                cartNo.forEach((element) => {
                    element.innerHTML = `${data}`
                })
                if (btn.innerHTML == "Buy") {
                    window.location.href = "e_order.php"
                }
            } else if (type == 'remove') {
                let cartNo = document.querySelectorAll(".cart-no")
                let totalProducts = document.querySelector(".t-products")
                cartNo.forEach((element) => {
                    element.innerHTML = `${data}`
                })
                btn.parentNode.remove()
                totalProducts.innerHTML = totalProducts.innerHTML - 1
                let productPrice = btn.parentNode.children[0].children[0].children[1].children[2].innerHTML
                let realPrice = productPrice.slice(11)
                let product_qty = btn.parentNode.children[0].children[1].innerHTML.slice(10)

                let totalPrice = document.querySelector(".t-price")
                let setTotalPrice = totalPrice.innerHTML - realPrice * product_qty
                totalPrice.innerHTML = setTotalPrice
            }
        })
}

// For changing background color of Objects 

let prevbtn;
function change_background(btn) {
    if (prevbtn != undefined) {
        prevbtn.style.color = "#000000"
        prevbtn.style.background = "linear-gradient(20deg, #FFECD2, #FFECD2)"
    }
    btn.style.background = "linear-gradient(20deg,#764BA2, #667EEA)";
    btn.style.color = "#fff"
    prevbtn = btn
}

// For cancelling the order

function cancelOrder(cancelBtn,ordid) {

    if (confirm("Are you sure!")) {
        data = {
            'ordid': ordid
        }
        jsondata = JSON.stringify(data);

        fetch("handles/cancel-order.php", {
            method: "POST",
            body: jsondata,
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then((res) => res.text())
            .then((data) => {
                if (data == "fail") {
                    alert("some error occured! please try later")
                } else {
                cancelBtn.parentNode.outerHTML = '<p>order cancelled</p>'
                }
            })
    }
}
// Script for slider 

var ham = document.querySelector("#hamburger")
var cross = document.querySelector("#cross")
var nav = document.querySelector(".nav")

function come() {
    nav.style.marginLeft = "0px"
    ham.setAttribute("hidden", null)
    if (document.querySelector(".search")) {
        let search = document.querySelector(".mobile-search")
        let searchBtn = document.querySelector(".srhIcon")
        search.style.display = "none"
        searchBtn.style.display = "none"
    }
}
function go() {
    nav.style.marginLeft = "-245px"
    setTimeout(function () {
        ham.removeAttribute("hidden")
    }, 150)
    if (document.querySelector(".search")) {
        let search = document.querySelector(".mobile-search")
        let searchBtn = document.querySelector(".srhIcon")
        search.style.display = ""
        searchBtn.style.display = ""
    }
}


// script for changing status of main categories

function status_chng(id, btn) {
    var stat = 0

    if (btn.innerHTML == "Deactive") {
        stat = 1
    }
    stat = parseInt(stat)

    let mydata = {
        'status': stat,
        'catId': id
    }
    jsondata = JSON.stringify(mydata)
    fetch("mainActHandle/change_mstatus.php", {
        method: "POST",
        body: jsondata,
        headers: {
            'Content-type': 'application/json'
        }
    })
        .then((res) => res.text())
        .then((data) => {
            if (data == "no") {
                alert('Some technical issue, Try Later Please!')
            }
            else {
                if (stat == 0) {
                    btn.classList = "btn action-btn btn-red"
                    btn.innerHTML = "Deactive"
                }
                else {
                    btn.classList = "btn action-btn"
                    btn.innerHTML = "Active"
                }
            }
        })

}

function delMainCat(id, btn) {
    let mydata = {
        'catId': id
    }
    jsondata = JSON.stringify(mydata)
    fetch("mainActHandle/del_mainCat.php", {
        method: "POST",
        body: jsondata,
        headers: {
            'Content-type': 'application/json'
        }
    })
        .then((res) => res.text())
        .then((data) => {
            if (data == "no") {
                alert('Some technical issue, Try Later Please!')
            }
            else {
                btn.parentNode.parentNode.remove()
            }
        })

}

// script for making modal come and go
var modal = document.querySelector(".myModal")
var row

function editCat(btn, catId) {
    let categoryId = document.querySelector("#cat_id")
    categoryId.value = catId
    row = btn.parentNode.parentNode.children
    let category = row[1].innerHTML
    let updateCat = document.querySelector("#updateCatName")
    updateCat.setAttribute("value", category)
    modal.style.display = "flex"
}

function goEditModal() {
    modal.style.display = "none"
}






// script for handling actions of sub categories

function subStatusChange(id, btn) {
    var subStat = 0

    if (btn.innerHTML == "Deactive") {
        subStat = 1
    }
    subStat = parseInt(subStat)

    let mydata = {
        'status': subStat,
        'catId': id
    }
    jsondata = JSON.stringify(mydata)
    fetch("subActHandle/change_status.php", {
        method: "POST",
        body: jsondata,
        headers: {
            'Content-type': 'application/json'
        }
    })
        .then((res) => res.text())
        .then((data) => {
            console.log(data)
            if (data == "no") {
                alert('Some technical issue, Try Later Please!')
            }
            else {
                if (subStat == 0) {
                    btn.classList = "btn action-btn btn-red"
                    btn.innerHTML = "Deactive"
                }
                else {
                    btn.classList = "btn action-btn"
                    btn.innerHTML = "Active"
                }
            }
        })

}

function delSubCat(id, btn) {
    let mydata = {
        'catId': id
    }
    jsondata = JSON.stringify(mydata)
    fetch("subActHandle/del_subcat.php", {
        method: "POST",
        body: jsondata,
        headers: {
            'Content-type': 'application/json'
        }
    })
        .then((res) => res.text())
        .then((data) => {
            if (data == "no") {
                alert('Some technical issue, Try Later Please!')
            }
            else {
                btn.parentNode.parentNode.remove()
            }
        })

}

// check the size and selection of the image only 5 mb allowed

function checkImgSize(event) {
    
}

function checkSelection(uploadBtn) {
    var file = uploadBtn.files[0];
    var maxSizeInBytes = 5 * 1024 * 1024;
    var greenTick = uploadBtn.parentElement.children[2];


    if (file && file.size > maxSizeInBytes) {
        uploadBtn.parentNode.insertAdjacentHTML('beforeend','<p class="notify notify-photo">Image too big</p>')
        uploadBtn.value = null;
        greenTick.style.height = "0px"
    }
    else if (uploadBtn.files.length > 0) {
        greenTick.style.height = "30px"
    }
}

// javascript to delete a product 

function delProduct(prId, btn) {
    let mydata = {
        'product_id': prId
    }
    jsondata = JSON.stringify(mydata)
    fetch("productHandle/del_product.php", {
        method: "POST",
        body: jsondata,
        headers: {
            'Content-type': 'application/json'
        }
    })
        .then((res) => res.text())
        .then((data) => {
            if (data == "Img delete unsuccessful!") {
                alert('Some technical issue! Try Later Please')
            }
            else if (data == "Delete unsuccessful!") {
                alert("deletion unsuccessful! try later please")
            }
            else {
                btn.parentNode.parentNode.remove()
            }
        })

}

// javascript to delete a contact message

function delContact(msId, btn) {
    let mydata = {
        'message_id': msId
    }
    jsondata = JSON.stringify(mydata)
    fetch("HandleDelete/del_contact.php", {
        method: "POST",
        body: jsondata,
        headers: {
            'Content-type': 'application/json'
        }
    })
        .then((res) => res.text())
        .then((data) => {
            if (data == "Delete unsuccessful") {
                alert('Some technical issue! Try Later Please')
            }
            else {
                btn.parentNode.parentNode.remove()
            }
        })

}

// for deleting users

function delUser(userId, btn) {
    let mydata = {
        'userId': userId
    }
    jsondata = JSON.stringify(mydata)
    fetch("HandleDelete/del_user.php", {
        method: "POST",
        body: jsondata,
        headers: {
            'Content-type': 'application/json'
        }
    })
        .then((res) => res.text())
        .then((data) => {
            if (data == "Delete unsuccessful") {
                alert('Some technical issue! Try Later Please')
            }
            else {
                btn.parentNode.parentNode.remove()
            }
        })

}
 

// for deleting admin users

function delAdminUser(adminId, btn) {
    let mydata = {
        'adminId': adminId
    }
    jsondata = JSON.stringify(mydata)
    fetch("HandleDelete/del_admin_user.php", {
        method: "POST",
        body: jsondata,
        headers: {
            'Content-type': 'application/json'
        }
    })
        .then((res) => res.text())
        .then((data) => {
            if (data == "Delete unsuccessful") {
                alert('Some technical issue! Try Later Please')
            }
            else {
                btn.parentNode.parentNode.remove()
            }
        })

}




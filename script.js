function changeView() {

    var signinBox = document.getElementById("signinBox");
    var signupBox = document.getElementById("signupBox");

    signinBox.classList.toggle("d-none");
    signupBox.classList.toggle("d-none");

}

function showAlert(title, text, icon) {

    return swal.fire({
        title: title,
        text: text,
        icon: icon,
        color: "#fff"
    });

}

function signup() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var email = document.getElementById("email");
    var password = document.getElementById("password");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("password", password.value);

    var req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Your account created Successfully, Sign in to your account to continue", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }

        }
    }

    req.open("POST", "signup-process.php", true);
    req.send(form);
}

function signin() {

    var email = document.getElementById("em");
    var password = document.getElementById("pw");
    var rememberMe = document.getElementById("rmb");

    var form = new FormData();
    form.append("em", email.value);
    form.append("pw", password.value);
    form.append("rmb", rememberMe.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Singed In Successfully", "success").then(() => {
                    window.location = "home.php";
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "signin-process.php", true);
    req.send(form);
}

function forgotPassword() {
    var email = document.getElementById("email");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Email sent, Check your inbox!", "success");
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("GET", "forgot-password-process.php?email=" + email.value, true);
    req.send();
}

function resetPassword() {
    var pw = document.getElementById("pw");
    var cpw = document.getElementById("cpw");
    var vcode = document.getElementById("vcode");

    var form = new FormData();
    form.append("pw", pw.value);
    form.append("cpw", cpw.value);
    form.append("vcode", vcode.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Password resetted Successfully, Sign-In to continue!", "success").then(() => {
                    window.location = "sign-In.php";
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "reset-password-process.php", true);
    req.send(form);
}

function adminSignIn() {

    var email = document.getElementById("adminEmail");
    var password = document.getElementById("adminPassword");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Signed In Successfully!", "success").then(() => {
                    window.location = "admin-dashboard.php";
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    };

    req.open("POST", "admin-signin-process.php", true);
    req.send(form);
}


function loadUsers(page) {

    var searchTxt = document.getElementById("adminUserSearch");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("content").innerHTML = resp;
        }
    };

    req.open("GET", "load-users-process.php?page=" + page + "&searchTxt=" + searchTxt.value, true);
    req.send();
}

function changeUserStatus(id, status) {
    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;

            if (resp == "success") {
                showAlert("Success", "Status Changed Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }

        }
    }
    req.open("GET", "change-user-status-process.php?id=" + id + "&s=" + status, true);
    req.send();
}

function loadProducts(page) {

    var searchTxt = document.getElementById("productSearchTxt");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("content").innerHTML = resp;
        }
    };

    req.open("GET", "load-products-process.php?page=" + page + "&searchTxt=" + searchTxt.value, true);
    req.send();
}

function changeProductStatus(id) {
    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                window.location.reload();
            } else {
                alert(resp);
            }

        }
    }
    req.open("GET", "change-product-status-process.php?id=" + id, true);
    req.send();
}

function registerBrand() {
    var brand = document.getElementById("brandName");

    var form = new FormData();
    form.append("brand", brand.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;

            if (resp == "success") {
                showAlert("Success", "Brand Registered Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }
    req.open("POST", "register-brand-process.php", true);
    req.send(form);
}

function registerCategory() {
    var category = document.getElementById("categoryName");

    var form = new FormData();
    form.append("category", category.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Category Registered Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }


        }
    }
    req.open("POST", "register-category-process.php", true);
    req.send(form);
}

function changeBrandStatus(id) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;

            if (resp == "success") {
                showAlert("Success", "Brand Updated Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }

        }
    }
    req.open("GET", "change-brand-status-process.php?id=" + id, true);
    req.send();
}

function changeCategoryStatus(id) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;

            if (resp == "success") {
                showAlert("Success", "Brand Updated Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }

        }
    }
    req.open("GET", "change-category-status-process.php?id=" + id, true);
    req.send();
}

function changeProductImage() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {
        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + " files. You are proceed to upload only 3 or less than 3 files.");
        }
    }

}

function registerProduct() {

    var name = document.getElementById("productName");
    var desc = document.getElementById("productDesc");
    var category = document.getElementById("productCategory");
    var brand = document.getElementById("productBrand");
    var image = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("name", name.value);
    form.append("desc", desc.value);
    form.append("category", category.value);
    form.append("brand", brand.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("image" + x, image.files[x]);
    }


    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Product Registered Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "register-product-process.php", true);
    req.send(form);

}

function loadProdUpdateData(id) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            var data = JSON.parse(resp);

            document.getElementById("uProdId").value = data.id;
            document.getElementById("uProdName").value = data.name;
            document.getElementById("uProdDesc").value = data.description;
            document.getElementById("uProdCategory").value = data.cat_id;
            document.getElementById("uProdBrand").value = data.brand_id;

            new bootstrap.Modal("#updateProductModal").show();
        }
    };

    req.open("GET", "get-product-details.php?id=" + id, true);
    req.send();
}

function updateProductImage() {

    var image = document.getElementById("uImageUploader");

    image.onchange = function () {
        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("ui" + x).src = url;
            }

        } else {
            alert(file_count + " files. You are proceed to upload only 3 or less than 3 files.");
        }
    }

}

function updateProduct() {

    var id = document.getElementById("uProdId");
    var name = document.getElementById("uProdName");
    var desc = document.getElementById("uProdDesc");
    var cat = document.getElementById("uProdCategory");
    var brand = document.getElementById("uProdBrand");
    var image = document.getElementById("uImageUploader");

    var form = new FormData();
    form.append("id", id.value);
    form.append("name", name.value);
    form.append("desc", desc.value);
    form.append("cat", cat.value);
    form.append("brand", brand.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("image" + x, image.files[x]);
    }


    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Product Updated Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "update-product-process.php", true);
    req.send(form);
}

function loadStock(page) {

    var searchTxt = document.getElementById("stockSearchTxt");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("content").innerHTML = resp;
        }
    };

    req.open("GET", "load-stock-process.php?page=" + page + "&searchTxt=" + searchTxt.value, true);
    req.send();
}

function changeStockStatus(id) {
    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                window.location.reload();
            } else {
                alert(resp);
            }

        }
    }
    req.open("GET", "change-stock-status-process.php?id=" + id, true);
    req.send();
}

function addStock() {

    var product = document.getElementById("product");
    var qty = document.getElementById("qty");
    var price = document.getElementById("unitPrice");
    var warenty = document.getElementById("warenty");
    var discount = document.getElementById("discount");

    var form = new FormData();
    form.append("product", product.value);
    form.append("qty", qty.value);
    form.append("price", price.value);
    form.append("warenty", warenty.value);
    form.append("discount", discount.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Stock Added Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "add-stock-process.php", true);
    req.send(form);

}

function loadStockUpdateData(id) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            var data = JSON.parse(resp);

            document.getElementById("uStockId").value = data.stock_id;
            document.getElementById("uStockProduct").value = data.product_id;
            document.getElementById("uStockQty").value = data.qty;
            document.getElementById("uStockUnitPrice").value = data.price;
            document.getElementById("uWarenty").value = data.warenty;
            document.getElementById("uDiscount").value = data.discount;

            new bootstrap.Modal("#updateStockModel").show();
        }
    };

    req.open("GET", "get-stock-details.php?stock_id=" + id, true);
    req.send();
}

function updateStock() {

    var stockId = document.getElementById("uStockId");
    var warenty = document.getElementById("uWarenty");
    var discount = document.getElementById("uDiscount");

    var form = new FormData();
    form.append("stock", stockId.value);
    form.append("warenty", warenty.value);
    form.append("discount", discount.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Stock Updated Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "update-stock-process.php", true);
    req.send(form);

}

function printReport() {

    var original = document.body.innerHTML;
    var printArea = document.getElementById("printArea");

    document.body.innerHTML = printArea.innerHTML;

    window.print();

    document.body.innerHTML = original;

}

function printReport2() {

    window.print();

}


function uploadProfileImg() {
    var profileImg = document.getElementById("profileImg");

    var form = new FormData();
    form.append("img", profileImg.files[0]);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Profile Image Updated Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "update-profile-img-process.php", true);
    req.send(form);
}


function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var no = document.getElementById("no");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var city = document.getElementById("city");
    var destrict = document.getElementById("destrict");
    var pcode = document.getElementById("pcode");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("mobile", mobile.value);
    form.append("no", no.value);
    form.append("line1", line1.value);
    form.append("line2", line2.value);
    form.append("city", city.value);
    form.append("destrict", destrict.value);
    form.append("pcode", pcode.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Profile Updated Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "update-user-profile-process.php", true);
    req.send(form);
}

function myFunction(imgs) {
    // Get the expanded image
    var expandImg = document.getElementById("expandedImg");
    // Get the image text
    var imgText = document.getElementById("imgtext");
    // Use the same src in the expanded image as the image being clicked on from the grid
    expandImg.src = imgs.src;
    // Use the value of the alt attribute of the clickable image as text inside the expanded image
    imgText.innerHTML = imgs.alt;
    // Show the container element (hidden with CSS)
    expandImg.parentElement.style.display = "block";
}

let slideIndex = 0;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("demo");
    let captionText = document.getElementById("caption");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    captionText.innerHTML = dots[slideIndex - 1].alt;
}

function loadDescription(product) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("productContent").innerHTML = resp;
        }
    };

    req.open("GET", "load-product-description.php?product=" + product, true);
    req.send();

}

function categorySearch(page, catId) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("catSearchResults").innerHTML = resp;
        }
    }

    req.open("GET", "search-by-category-process.php?catId=" + catId.value + "&page=" + page, true);
    req.send();
}

function loadProductsOnSale(page) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("onSaleContent").innerHTML = resp;
        }
    };

    req.open("GET", "load-onsale-products.php?page=" + page, true);
    req.send();
}

function loadCartProcess() {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("cartContent").innerHTML = resp;
        }
    }

    req.open("GET", "load-cart-process.php", true);
    req.send();
}

function addToCart(stock) {
    var qty = document.getElementById("qty");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success1") {
                showAlert("Success", "Cart Quantity Updated Successfully!", "success").then(() => {
                    loadCartProcess();
                });
            } else if (resp == "success2") {
                showAlert("Success", "Added to the Cart Successfully!", "success").then(() => {
                    loadCartProcess();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("GET", "add-to-cart-process.php?stock=" + stock + "&qty=" + qty.value, true);
    req.send();
}

function removeFromCart(cartId) {


    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Cart item removed Successfully!", "success").then(() => {
                    loadCartProcess();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("GET", "remove-from-cart-process.php?id=" + cartId, true);
    req.send();
}

function incrementCartQty(cartId) {

    var qty = document.getElementById("qty-" + cartId);
    var newQty = parseInt(qty.value) + 1;

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                loadCartProcess();
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("GET", "update-cart-qty-process.php?id=" + cartId + "&qty=" + newQty, true);
    req.send();
}

function decrementCartQty(cartId) {

    var qtyE = document.getElementById("qty-" + cartId);
    var newQty = parseInt(qtyE.value) - 1;

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                loadCartProcess();
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("GET", "update-cart-qty-process.php?id=" + cartId + "&qty=" + newQty, true);
    req.send();
}

function addToWishlist(stock) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Product Added to Wishlist Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("GET", "add-to-wishlist-process.php?stock=" + stock, true);
    req.send();
}

function loadWishlistProcess() {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("wishlistContent").innerHTML = resp;
        }
    }

    req.open("GET", "load-wishlist-process.php", true);
    req.send();
}

function removeFromWishlist(wishlistId) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Wishlist item removed Successfully!", "success").then(() => {
                    loadWishlistProcess();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("GET", "remove-from-wishlist-process.php?id=" + wishlistId, true);
    req.send();
}

function search(page) {
    var search = document.getElementById("search");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("content").innerHTML = resp;
        }
    }

    req.open("GET", "search-product-process.php?search=" + search.value + "&page=" + page, true);
    req.send();
}

function filter(page) {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var priceFrom = document.getElementById("priceFrom");
    var priceTo = document.getElementById("priceTo");
    var search = document.getElementById("search");
    var sort = document.getElementById("sort");

    var form = new FormData();
    form.append("category", category.value);
    form.append("brand", brand.value);
    form.append("priceFrom", priceFrom.value);
    form.append("priceTo", priceTo.value);
    form.append("search", search.value);
    form.append("sort", sort.value);
    form.append("page", page);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("content").innerHTML = resp;
        }
    }

    req.open("POST", "filter-products-process.php", true);
    req.send(form);
}


//Scroll Horizontally Home Page

function scrollMenuLeft() {
    document.querySelector('.scrollable-menu').scrollBy({
        left: -200, // Adjust as needed
        behavior: 'smooth'
    });
}

function scrollRight() {
    document.querySelector('.scrollable-menu').scrollBy({
        left: 200, // Adjust as needed
        behavior: 'smooth'
    });
}

//Scroll Horizontally Special Items

function scrollMenuLeft2() {
    document.querySelector('.scrollable-menu2').scrollBy({
        left: -200, // Adjust as needed
        behavior: 'smooth'
    });
}

function scrollRight2() {
    document.querySelector('.scrollable-menu2').scrollBy({
        left: 200, // Adjust as needed
        behavior: 'smooth'
    });
}

function scrollMenuLeft3() {
    document.querySelector('.scrollable-menu3').scrollBy({
        left: -200, // Adjust as needed
        behavior: 'smooth'
    });
}

function scrollRight3() {
    document.querySelector('.scrollable-menu3').scrollBy({
        left: 200, // Adjust as needed
        behavior: 'smooth'
    });
}

// Messages User Side

function sendMessage(user) {
    var message = document.getElementById("messageInput");

    var form = new FormData();
    form.append("message", message.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                document.getElementById('messageInput').value = '';
                loadMessages(user);
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "send-messages.php", true);
    req.send(form);
}


function loadMessages(user) {

    var messagesContainer = document.getElementById('messages');
    var div = document.getElementById('scrollMsg');

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var json = req.responseText;
            var messages = JSON.parse(json);
            messagesContainer.innerHTML = '';
            messages.forEach(function (msg) {
                var messageDiv = document.createElement('div');
                messageDiv.classList.add("message");
                messageDiv.textContent = msg.message;
                if (msg.sender == user) {
                    if (msg.status == 0) {
                        messageDiv.classList.add("delivered");
                    } else {
                        messageDiv.classList.add("sent");
                    }
                } else {
                    messageDiv.classList.add("received");
                }
                messagesContainer.appendChild(messageDiv);
                div.scrollTop = div.scrollHeight;
                //setInterval(loadMessages(user), 10000);
            });
        }
    }

    req.open("GET", "get-messages.php?user=" + user, true);
    req.send();

}


function loadChats(status) {
    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("adminChatContent").innerHTML = resp;
        }
    }

    req.open("GET", "load-admin-chat-process.php?status=" + status, true);
    req.send();
}

var adminChatUserId = 0;

function loadAdminChat(userId) {

    var messagesContainer = document.getElementById('adminMessages');
    var div = document.getElementById('scrollMsg');
    adminChatUserId = userId;

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var json = req.responseText;
            var messages = JSON.parse(json);
            messagesContainer.innerHTML = '';
            messages.forEach(function (msg) {
                var messageDiv = document.createElement('div');
                messageDiv.classList.add("message");
                messageDiv.textContent = msg.message;
                if (msg.receiver == userId) {
                    if (msg.status == 0) {
                        messageDiv.classList.add("delivered");
                    } else {
                        messageDiv.classList.add("sent");
                    }
                } else {
                    messageDiv.classList.add("received");
                }
                messagesContainer.appendChild(messageDiv);
                div.scrollTop = div.scrollHeight;
                //setInterval(loadAdminChat(userId), 10000);
            });
        }
    }

    req.open("GET", "get-admin-messages.php?user=" + userId, true);
    req.send();

}

function sendAdminMessage() {
    var message = document.getElementById("adminMessageInput");

    var form = new FormData();
    form.append("message", message.value);
    form.append("user", adminChatUserId);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                document.getElementById('adminMessageInput').value = '';
                loadAdminChat(adminChatUserId);
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "send-admin-messages.php", true);
    req.send(form);
}

function loadCharts() {
    loadSalesChart();
    loadRevenueCatChart();
    loadMostPopularProducts();
}

function loadSalesChart() {
    const chart1 = document.getElementById('chart1');

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            var json = JSON.parse(resp);

            new Chart(chart1, {
                type: 'line',
                data: {
                    labels: json.date,
                    datasets: [{
                        label: 'Total Sales',
                        data: json.total_sales,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        }
    }
    req.open("GET", "sales-overview-data.php", true);
    req.send();
}

function loadRevenueCatChart() {
    var chart2 = document.getElementById('chart2');

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            var json = JSON.parse(resp);

            new Chart(chart2, {
                type: 'pie',
                data: {
                    labels: json.cat_name,
                    datasets: [{
                        label: 'Revenue Breakdown By Category',
                        data: json.revenue,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });

        }
    }
    req.open("GET", "revenue-chart-data.php", true);
    req.send();
}

function loadMostPopularProducts() {
    const chart = document.getElementById('chart3');

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            var json = JSON.parse(resp);

            new Chart(chart, {
                type: 'bar',
                data: {
                    labels: json.product,
                    datasets: [{
                        label: 'Top Selling Products',
                        data: json.qty,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                }
            });

        }
    }
    req.open("GET", "top-selling-chart-data.php", true);
    req.send();
}

function checkout() {

    var form = new FormData();
    form.append("cart", true);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var json = req.responseText;
            console.log(json);

            var resp = JSON.parse(json);
            if (resp.status == "success") {
                doCheckout(resp.payment, "checkout-process.php");
            } else {
                showAlert("Warning", resp.error, "warning");
            }
        }
    }
    req.open("POST", "payment-process.php", true);
    req.send(form);
}

function doCheckout(payment, url) {

    payhere.onCompleted = function onCompleted(orderId) {

        var form = new FormData();
        form.append("payment", JSON.stringify(payment));

        var req = new XMLHttpRequest();
        req.onreadystatechange = function () {
            if (req.readyState == 4 && req.status == 200) {
                var json = req.responseText;
                console.log(json);
                var resp = JSON.parse(json);

                if (resp.status == "success") {
                    showAlert("Success", "Order Success!", "success").then(() => {
                        window.location.href = "invoice.php?orderId=" + resp.ohId;
                    });
                } else {
                    showAlert("Error", resp.error, "error");
                }
            }
        }
        req.open("POST", url, true);
        req.send(form);
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        showAlert("Warning", "Payment dismissed", "warning");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        showAlert("Error", error, "error");
    };

    payhere.startPayment(payment);

}

function buyNow(stockId) {
    var qty = document.getElementById("qty");

    if (qty.value > 0) {

        var form = new FormData();
        form.append("cart", false);
        form.append("stockId", stockId);
        form.append("qty", qty.value);

        var req = new XMLHttpRequest();
        req.onreadystatechange = function () {
            if (req.readyState == 4 && req.status == 200) {
                var json = req.responseText;

                var resp = JSON.parse(json);
                if (resp.status == "success") {
                    resp.payment.stockId = stockId;
                    resp.payment.qty = qty.value;

                    doCheckout(resp.payment, "buy-now-process.php");
                } else {
                    showAlert("Warning", resp.error, "warning");
                }
            }
        }
        req.open("POST", "payment-process.php", true);
        req.send(form);

    } else {
        showAlert("Warning", "Quantity cannot be less than 1", "warning");
    }
}


function loadPurchaseHistoryProcess(sort) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("purchaseHistoryContent").innerHTML = resp;
        }
    }

    req.open("GET", "load-order-history-process.php?sort=" + sort, true);
    req.send();
}


function saveFeedback(id) {

    var feedback = document.getElementById("feed");
    const rating = document.querySelector('input[name="rating"]:checked');

    if (rating == null) {
        showAlert("Error", "Please select stars to give your rating to this product", "error");
    } else {

        var form = new FormData();
        form.append("pid", id);
        form.append("rating", rating.value);
        form.append("f", feedback.value);

        var request = new XMLHttpRequest();

        request.onreadystatechange = function () {
            if (request.status == 200 & request.readyState == 4) {
                var resp = request.responseText;

                if (resp == "success") {
                    showAlert("Success", "Feedback Saved!", "success").then(() => {
                        window.location.reload();
                    });
                } else {
                    showAlert("Error", resp, "error");
                }

            }
        }

        request.open("POST", "saveFeedbackProcess.php", true);
        request.send(form);
    }
}

function updateFeedback(id) {

    var feedback = document.getElementById("ufeed");
    const rating = document.querySelector('input[name="urating"]:checked');

    if (rating == null) {
        showAlert("Error", "Please select stars to give your rating to this product", "error");
    } else {

        var form = new FormData();
        form.append("pid", id);
        form.append("rating", rating.value);
        form.append("f", feedback.value);

        var request = new XMLHttpRequest();

        request.onreadystatechange = function () {
            if (request.status == 200 & request.readyState == 4) {
                var resp = request.responseText;

                if (resp == "success") {
                    showAlert("Success", "Feedback Saved!", "success").then(() => {
                        window.location.reload();
                    });
                } else {
                    showAlert("Error", resp, "error");
                }

            }
        }

        request.open("POST", "updateFeedbackProcess.php", true);
        request.send(form);

    }

}

function loadCustomerOrders(status) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("orderContent").innerHTML = resp;
        }
    }

    req.open("GET", "dashboard-load-order-process.php?status=" + status, true);
    req.send();
}

function updateOrderStatus(invoiceId) {

    var status = document.getElementById("orderStatus");

    var form = new FormData();
    form.append("invoiceId", invoiceId);
    form.append("status", status.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;

            if (resp == "success") {
                showAlert("Success", "Order Status Updated!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }

        }
    }

    req.open("POST", "update-order-status-process.php", true);
    req.send(form);
}

function saveMsg() {
    var fname = document.getElementById("fName");
    var lname = document.getElementById("lName");
    var email = document.getElementById("email");
    var message = document.getElementById("message");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("email", email.value);
    form.append("message", message.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var resp = request.responseText;

            if (resp == "success") {
                showAlert("Success", "Your Message Saved, Our team will send you a email shortly!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }

        }
    }

    request.open("POST", "leave-message-process.php", true);
    request.send(form);

}

function loadQuestionProcess(page) {
    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            document.getElementById("questionContent").innerHTML = resp;
        }
    }

    req.open("GET", "load-question-process.php?page=" + page, true);
    req.send();
}

function removeFromMessage(msgId) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Message removed Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("GET", "remove-message-process.php?id=" + msgId, true);
    req.send();
}

function addBannerImage() {

    var bannerImg = document.getElementById("bannerimageuploader");

    var form = new FormData();
    form.append("bannerImg", bannerImg.files[0]);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Banner Image Uploaded Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("POST", "upload-banner-img-process.php", true);
    req.send(form);
}


function changeBannerImage() {

    var image = document.getElementById("bannerimageuploader");

    image.onchange = function () {

        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("bannerImg").src = url;

    }

}

function deleteBannerImage(bannerId) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resp = req.responseText;
            if (resp == "success") {
                showAlert("Success", "Banner Image Deleted Successfully!", "success").then(() => {
                    window.location.reload();
                });
            } else {
                showAlert("Error", resp, "error");
            }
        }
    }

    req.open("GET", "delete-banner-img-process.php?bannerId=" + bannerId, true);
    req.send();
}
function changeView() {
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");

}

function signUp() {
    // alert("ok");
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email1");
    var password1 = document.getElementById("password1");
    var rpassword1 = document.getElementById("rpassword1");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("email", email.value);
    form.append("password1", password1.value);
    form.append("rpassword1", rpassword1.value);
    form.append("mobile", mobile.value);
    form.append("gender", gender.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "success") {
                fname.value = "";
                lname.value = "";
                email.value = "";
                password1.value = "";
                rpassword1.value = "";
                mobile.value = "";
                document.getElementById("msg").innerHTML = "";
                changeView();
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "SignUpProcess.php", true);
    r.send(form);

    // alert(fname.value);
    // alert(lname.value);
    // alert(email.value);
    // alert(password.value);
    // alert(mobile.value);
    // alert(gender.value);
}

function signIn() {
    // alert("signIn");
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberMe = document.getElementById("rememberMe");

    // alert(email.value);
    // alert(password.value);

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rememberMe", rememberMe.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "home.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "SignInProcess.php", true);
    r.send(form);
}

function forgotpassword() {
    // alert("forgotpassword");
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification code Sent to your Email. Please Check the index");
                var m = document.getElementById("forgotpasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "forgotPassword.php?e=" + email.value, true);
    r.send();
}

function showPassword() {
    // alert("ok");
    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (npb.innerHTML == "Show") {
        np.type = "text";
        npb.innerHTML = "Hide";
    } else {
        np.type = "password";
        npb.innerHTML = "Show";
    }
}

function RshowPassword() {
    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnpb.innerHTML == "Show") {
        rnp.type = "text";
        rnpb.innerHTML = "Hide";
    } else {
        rnp.type = "password";
        rnpb.innerHTML = "Show";
    }
}

function resetPassword() {
    // alert("ok");
    var e = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    // alert(e.value);
    // alert(np.value);
    // alert(rnp.value);
    // alert(vc.value);

    var form = new FormData();
    form.append("e", e.value);
    form.append("np", np.value);
    form.append("rnp", rnp.value);
    form.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("Password reset success..");
                bm.hide();
            } else {
                alert(text);
            }
        }
    };

    r.open("POST", "resetPassword.php", true);
    r.send(form);
}

function SignOut() {
    // alert("signOut");
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "home.php";
            }
        }
    };

    r.open("GET", "SignOutProcess.php", true);
    r.send();
}

//CSS TEXT REVEALING ANIMATION

function changeProductImg() {
    // alert("okkkk");

    var image = document.getElementById("imageUploader");
    var view = document.getElementById("prev");

    image.onchange = function() {

        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        view.src = url;

    }
}

function addProduct() {

    // alert("add");
    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");

    var condition;

    if (document.getElementById("bn").checked) {
        condition = 1;
    } else if (document.getElementById("us").checked) {
        condition = 2;

    }

    var color;

    if (document.getElementById("clr1").checked) {
        color = 1;

    } else if (document.getElementById("clr2").checked) {
        color = 2;

    } else if (document.getElementById("clr3").checked) {
        color = 3;

    } else if (document.getElementById("clr4").checked) {
        color = 4;

    } else if (document.getElementById("clr5").checked) {
        color = 5;

    } else if (document.getElementById("clr6").checked) {
        color = 6;

    }

    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageUploader");

    // alert(title.value);
    // alert(price.value);

    var f = new FormData();
    f.append("c", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("co", condition);
    f.append("col", color);
    f.append("qty", qty.value);
    f.append("p", price.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("desc", description.value);
    f.append("img", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Success") {
                document.getElementById("msg2").innerHTML = text;
            } else {
                document.getElementById("msg").innerHTML = text;
            }

        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);


}

function changeImage() {
    // alert("changeImage");
    var image = document.getElementById("profileimg"); //file chooser
    var prev = document.getElementById("prev0"); //image tag

    image.onchange = function() {

        var file0 = this.files[0];

        var url0 = window.URL.createObjectURL(file0);

        prev.src = url0;
    }
}

function showMyPassword() {
    // alert("ok");
    var np = document.getElementById("mpid");
    var npb = document.getElementById("button-addon2");

    if (npb.innerHTML == "Show") {
        np.type = "text";
        npb.innerHTML = "Hide";
    } else {
        np.type = "password";
        npb.innerHTML = "Show";
    }
}

function updateProfile() {
    // alert("updateProfile");
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var addline1 = document.getElementById("addline1");
    var addline2 = document.getElementById("addline2");
    var city = document.getElementById("usercity");
    var shnm = document.getElementById("shnm");
    var image = document.getElementById("profileimg");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("a1", addline1.value);
    form.append("a2", addline2.value);
    form.append("c", city.value);
    form.append("shnm", shnm.value);
    form.append("i", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var text = r.responseText;
            alert(text);
        }
    };

    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);

    // alert(fname.value);
    // alert(lname.value);
    // alert(mobile.value);
    // alert(addline1.value);
    // alert(addline2.value);
    // alert(usercity.value);
    // alert(image.files[0])
}


function changeProductImg() {
    // alert("okkkk");

    var image = document.getElementById("imageUploader");
    var view = document.getElementById("prev");

    image.onchange = function() {

        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        view.src = url;

    }
}

function addProduct() {

    // alert("add");
    var category = document.getElementById("ca");
    var proShopName = document.getElementById("psn");
    var title = document.getElementById("ti");

    var color = document.getElementById("cl");

    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageUploader");

    // alert(title.value);
    // alert(price.value);
    // alert(proShopName.value);

    var f = new FormData();
    f.append("c", category.value);
    f.append("psn", proShopName.value);
    f.append("t", title.value);
    f.append("col", color.value);
    f.append("qty", qty.value);
    f.append("p", price.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("desc", description.value);
    f.append("img", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            // alert(text);
            if (text == "Success") {
                alert("Success");
                window.location = "addProduct.php";
            } else {
                alert("Error");
            }

        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);


}

function changeStatus(id) {

    var productId = id;
    // alert(productId);
    var statusChange = document.getElementById("flexSwitchCheckChecked");
    var statusLable = document.getElementById("checklLable" + productId);

    var status;

    if (statusChange.checked) {
        status = 1;
    } else {
        status = 2;
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Activated") {
                statusLable.innerHTML = "Make your product Active";
            } else if (text == "Deactivated") {
                statusLable.innerHTML = "Make your product Deactive";
            }
        }
    };

    r.open("GET", "statusChangeProcess.php?p=" + productId + "&s=" + status, true);
    r.send();

}

function addToWatchlist(id) {

    var wid = id;
    // alert(wid);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("New product has added to the watchlist.");

                document.getElementById("heart" + id).style.color = "blue";


            } else if (t == "success2") {
                alert("Product has removed from the watchlist.");

                document.getElementById("heart" + id).style.color = "white";


            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "addToWatchlistProcess.php?id=" + wid, true);
    r.send();
}


function deleteFromWatchlist(id) {

    var pid = id;
    // alert(pid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {

                window.location = "watchlist.php";

            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "deleteWatchlistProcess.php?id=" + pid, true);
    r.send();
}

function sendId(id) {
    var id1 = id;
    // alert(id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            }
        }
    };

    r.open("GET", "sendProductProcess.php?id=" + id1, true);
    r.send();
}

function pudateProduct() {
    // alert("pudateProduct");

    var title = document.getElementById("ti");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var Description = document.getElementById("desc");
    var image = document.getElementById("imageUploader");

    var form = new FormData();
    form.append("t", title.value);
    form.append("qty", qty.value);
    form.append("c", cost.value);
    form.append("dws", delivery_within_colombo.value);
    form.append("doc", delivery_outof_colombo.value);
    form.append("desc", Description.value);
    form.append("i", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };

    r.open("POST", "updateProcess.php", true);
    r.send(form);

}

function basicSearch(x) {
    // alert("ok");
    var searchText = document.getElementById("basic_search_txt").value;
    var searchSelect = document.getElementById("basic_search_select").value;

    // alert(searchText);
    // alert(searchSelect);

    var form = new FormData();
    form.append("st", searchText);
    form.append("ss", searchSelect);
    form.append("page", x)

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    };

    r.open("POST", "basicSearchProcess.php", true);
    r.send(form);

}

function adminVerification() {
    // alert("ok");
    var e = document.getElementById("e");

    var form = new FormData();
    form.append("e", e.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var verificationModel = document.getElementById("verification_model");
                k = new bootstrap.Modal(verificationModel);

                k.show();

            } else {
                alert(t);
            }

        }
    };

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(form);
}

function verify() {
    var v = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                window.location = "adminpanel.php";
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "verifyProcess.php?id=" + v.value, true);
    r.send();
}

function addToCart(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);

            if (t == "Please Sign In first.") {
                window.location = "index.php";
            }
        }
    }

    r.open("GET", `addToCartProcess.php?id=${id}`, true);
    r.send();
}

function deleteFromCart(id) {
    // alert(id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "success") {
                alert("Product Added to the Recent Successfully.");
                alert("Product removed from the Cart Successfully.");

                window.location = "cart.php";
            }
        }
    }

    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();

}

function viewmsgmodel() {
    // alert("ok");
    var m = document.getElementById("viewmsgmodel");
    mm = new bootstrap.Modal(m);
    mm.show();
}

var pm;

function viewProductModal(id) {

    var m = document.getElementById("viewProductModal" + id);
    pm = new bootstrap.Modal(m);
    pm.show();

}

var cm;

function addNewCategory() {
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var cvm;
var newCategory;
var uemail;

function categoryVerifyModal() {
    newCategory = document.getElementById("n").value;
    uemail = document.getElementById("e").value;

    var f = new FormData();
    f.append("n", newCategory);
    f.append("e", uemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                var m = document.getElementById("addCategoryModalVerification");
                cvm = new bootstrap.Modal(m);

                cm.hide();
                cvm.show();
            } else {
                alert(t);
            }
        }
    };
    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(f);
}

function saveCategory() {
    var txt = document.getElementById("txt").value;

    var f = new FormData();
    f.append("t", txt);
    f.append("c", newCategory);
    f.append("e", uemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                cvm.hide();
                alert("New category added.");
                window.location = "manageproducts.php";
            } else {
                alert(t);
            }
        }
    };
    r.open("POST", "saveNewCategoryProcess.php", true);
    r.send(f);
}

function productBlock(id) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            window.location = "manageproducts.php";
        }
    };
    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();
}

function loadChat() {
    setInterval(viewChat, 2000);
}

function viewChat() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("box1").innerHTML = text;
        }
    };

    r.open("GET", "viewchat.php", true);
    r.send();
}

function sendMsg() {
    // alert("ok");

    var recever_mail = document.getElementById("email");
    var msg_txt = document.getElementById("m");

    var f = new FormData();
    f.append("rm", recever_mail.value);
    f.append("mt", msg_txt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "done") {
                window.location = "message.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);

}

function advancedSearch(x) {

    var search_txt = document.getElementById("s1");
    var category = document.getElementById("ca1");
    var shop_name = document.getElementById("shn");
    var color = document.getElementById("clr");
    var price_from_txt = document.getElementById("pf1");
    var price_to_txt = document.getElementById("pt1");
    var sort = document.getElementById("sort");

    var form = new FormData();
    form.append("page", x);
    form.append("s", search_txt.value);
    form.append("ca", category.value);
    form.append("shn", shop_name.value);
    form.append("c1", color.value);
    form.append("p1", price_from_txt.value);
    form.append("p2", price_to_txt.value);
    form.append("sort", sort.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(form);

}

function payNow(id) {
    // alert(id);

    var qty = document.getElementById("qtyinput").value;
    // alert(qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];

            if (t == "1") {

                alert("Please log in or sign up");
                window.location = "index.php";

            } else if (t == "2") {

                alert("Please update your profile first");
                window.location = "myProfilenew.php";

            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {

                    saveInvoice(orderId, id, mail, amount, qty);
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221409", // Replace your Merchant ID
                    "return_url": "http://localhost/viva/singleProductView.php?id" + id, // Important
                    "cancel_url": "http://localhost/viva/singleProductView.php?id" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function(e) {
                payhere.startPayment(payment);

                // };
            }

        }
    };

    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

function saveInvoice(orderId, id, mail, amount, qty) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "saveInvoice.php", true);
    r.send(f);

}

function printInvoice() {

    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = body;

}
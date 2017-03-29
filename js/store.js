//----------------------------------------------------------------
// store (contains the products)
//
function store() {
    var storeData;
    $.ajax({
        method: "GET",
        url: "backend_products.php",
        cache: false,
        dataType: "JSON",
        async: false,
        success: function(data) {        
           storeData = data;  
        }
    });

    console.log(storeData);
    this.products = storeData;
}
store.prototype.getProduct = function (sku) {
    for (var i = 0; i < this.products.length; i++) {
        if (this.products[i].sku == sku)
            return this.products[i];
    }
    return null;
}

store.prototype.addProduct = function () {
    var productid = $("#productid").val();
    var productname = $("#productname").val();
    var productdesc = $("#productdesc").val();
    var productprice = $("#productprice").val();
    var productdetails = $("#productdetails").val();
    var productID;
    $.ajax({
        method: "POST",
        data: { id: productid, name: productname, description: productdesc, price: productprice, details: productdetails },
        url: "backend_addproducts.php",
        cache: false,
        async: false,
        success: function(data) {        
           productID = data;  
                        if (productID == productid) {
                            $("#addProd").html("Adding Product ...");
                            setTimeout('$("#addProd").html("Product Added!"); ', 3000);
                            setTimeout('$("#addProd").html("Redirecting ..."); ', 2000);
                            setTimeout(' window.location.href = ""; ', 4000);
                        } else {

                            $("#error").fadeIn(1000, function() {
                                $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Error adding product!</div>');
                                $("#addProd").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Add Product');
                            });
                        }

        }
    });            

    return productID;
}

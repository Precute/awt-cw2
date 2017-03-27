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

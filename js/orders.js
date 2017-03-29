//----------------------------------------------------------------
// orders (contains all the orders)
//
function orders() {
    var ordersData;
    $.ajax({
        method: "GET",
        url: "backend_getorders.php",
        cache: false,
        dataType: "JSON",
        async: false,
        success: function(data) {        
           ordersData = data;  
        }
    });

    console.log(ordersData);
    this.orders = ordersData;
}
orders.prototype.getOrder = function (transactionid) {
    for (var i = 0; i < this.orders.length; i++) {
        if (this.orders[i].transactionid == transactionid)
            return this.orders[i];
    }
    return null;
}

//----------------------------------------------------------------
// order class
function order(id, totalitems, totalprice, timeorderplaced, transactionid, TID, payer_email, first_name, last_name, amount, currency, country, txn_id, txn_type, payment_status, payment_type, payment_date, num_cart_items) {
    this.id = id; 
    this.totalitems = totalitems;
    this.totalprice = totalprice;
    this.timeorderplaced = timeorderplaced;
    this.transactionid = transactionid;
    this.TID = TID;
    this.payer_email = payer_email;
    this.first_name = first_name;
    this.last_name = last_name;
    this.amount = amount;
    this.currency = currency;
    this.country = country;
    this.txn_id = txn_id;
    this.txn_type = txn_type;
    this.payment_status = payment_status;
    this.payment_type = payment_type;
    this.payment_date = payment_date;
    this.num_cart_items = num_cart_items;
}

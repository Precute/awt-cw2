//----------------------------------------------------------------
// product class
function product(sku, name, description, price, details, created) {
    this.sku = sku; // product code (SKU = stock keeping unit)
    this.name = name;
    this.description = description;
    this.price = price;
    this.details = details;
    this.created = created;
}

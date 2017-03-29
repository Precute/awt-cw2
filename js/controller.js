'use strict';

// the storeController contains three objects:
// - store: contains the product list
// - cart: the shopping cart object
// - orders: the orders placed
function storeController($scope, $routeParams, DataService) {

    // get store and cart from service
    $scope.store = DataService.store;
    $scope.cart = DataService.cart;
	$scope.orders = DataService.orders;
    // use routing to pick the selected product
    if ($routeParams.productSku != null) {
        $scope.product = $scope.store.getProduct($routeParams.productSku);
    }
    if ($routeParams.transactionId != null) {
        $scope.order = $scope.orders.getOrder($routeParams.transactionId);
    }
}

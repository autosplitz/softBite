<template>
	<div>
		<div class="row">
			<div class="col-md-12">
				<button @click="handleOrderSave" class="btn btn-sm btn-info float-right">Order</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7">
				<div class="mb-5">
					<h3>Customer details</h3>
					<order-form @customerDetailsChanged="customerDetailsHandle" />
				</div>
				<div class="mb-5">
					<h3>
						Order details <span class="text-danger float-right" v-if="totalPrice > 0">{{ totalPrice }}</span>
					</h3>
					<order-details :order-details="orderDetails" />
				</div>
			</div>
			<div class="col-md-5">
				<h3>Menu</h3>
				<order-menu-items :items="this.menuItems" @addMenuItem="handleNewMenuItem" />
			</div>
		</div>
	</div>
</template>

<script>
	import OrderForm from "./OrderForm";
	import OrderMenuItems from "./OrderMenuItems";
	import OrderDetails from "./OrderDetails";
	import axios from "axios";

	export default {
		props: ["restoId"],
		components: {
			OrderForm,
			OrderMenuItems,
			OrderDetails,
		},
		created() {
			this.fetchMenuItems();
			window.eventBus.$on("addMenuItem", this.handleNewMenuItem);
			window.eventBus.$on("filteredList", this.handleFilteredList);
			window.eventBus.$on("clearFilteredList", this.handleClearFilteredList);
			window.eventBus.$on("removeOrderedItem", this.handleRemoveOrderedItem);
		},
		computed: {
			totalPrice() {
				let price = 0;
				this.orderDetails.forEach((order) => (price = price + order.price));
				return price;
			},
		},
		data() {
			return {
				menuItems: [],
				orderDetails: [],
				originalMenuItems: [],
				customerDetails: null,
			};
		},
		methods: {
			fetchMenuItems() {
				let postData = { restoId: this.restoId };
				axios
					.post("/api/menu-items", postData)
					.then((response) => {
						this.menuItems = response.data;
						this.originalMenuItems = response.data;
					})
					.catch((error) => console.error(error.response));
			},

			handleNewMenuItem(item) {
				this.orderDetails.unshift(item);
			},
			handleFilteredList(filteredList) {
				this.menuItems = filteredList;
			},
			handleClearFilteredList() {
				this.menuItems = this.originalMenuItems;
			},
			customerDetailsHandle(customer) {
				this.customerDetails = customer;
			},
			handleRemoveOrderedItem(item) {
				this.orderDetails = this.orderDetails.filter((orderedItem) => orderedItem.id != item.id);
			},
			handleOrderSave() {
				let orderedDetailsIds = [];
				this.orderDetails.forEach((item) => {
					orderedDetailsIds.push(item.id);
				});
				let orderData = {
					resto_id: this.restoId,
					order_data: {
						customerDetails: this.customerDetails,
						totalPrice: this.totalPrice,
						orderDetails: orderedDetailsIds,
					},
				};
				console.log(orderData);
				axios
					.post("/api/order/save", orderData)
					.then((res) => console.log(res))
					.catch((error) => console.log(error));
			},
		},
	};
</script>

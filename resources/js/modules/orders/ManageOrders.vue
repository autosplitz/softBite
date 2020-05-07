<template>
	<div>
		<table class="table table-hover table-borderless table-striped">
			<thead>
				<tr>
					<th>Order Id</th>
					<th>Amount</th>
					<th>Status</th>
					<th>Details</th>
					<th>Actions</th>
				</tr>
			</thead>
			<order-items :orders="orders.data"></order-items>
		</table>
	</div>
</template>

<script>
	import OrderItems from "../../components/OrderItems";
	export default {
    props: ["orders"],
    components:{
      OrderItems
    }
	};
</script>

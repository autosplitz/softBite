<template>
	<ul class="list-group">
		<li class="list-group-item" v-for="(orderDetail, key) in orderDetails" :key="key">
			{{ orderDetail.name }}
			<span class="float-right">
				{{ orderDetail.price }}
				<span class="ml-3 pointer badge badge-danger" @click="handleRemoveItem(orderDetail)">X</span>
			</span>
		</li>
	</ul>
</template>

<script>
	export default {
		props: ["orderDetails"],
		methods: {
			handleRemoveItem(item) {
				window.eventBus.$emit("removeOrderedItem", item);
			},
		},
	};
</script>

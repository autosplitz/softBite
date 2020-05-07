<template>
	<div class="wrapper">
		<form action="#">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control form-control-sm" v-model="customer.name" id="name" />
			</div>
			<div class="form-group">
				<label for="phone">Phone</label>
				<input type="text" class="form-control form-control-sm" v-model="customer.phone" id="phone" />
			</div>
			<div class="form-group">
				<label for="address">Address</label>
				<input type="text" class="form-control form-control-sm" v-model="customer.address" id="address" />
			</div>
		</form>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				customer: {
					name: "",
					phone: "",
					address: "",
				},
			};
		},
		watch: {
			customer: {
				handler(value) {
					let customer = {
						name: value.name,
						phone: value.phone,
						address: value.address,
					};
					this.$emit("customerDetailsChanged", customer);
				},
				deep: true,
			},
		},
	};
</script>

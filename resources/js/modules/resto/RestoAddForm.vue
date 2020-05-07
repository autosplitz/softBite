<template>
	<div class="resto_add_form_wrapper">
		<h4>Add new Restaurant</h4>
		<div class="form-group">
			<label for="name">Name</label>
			<input v-model="resto.name" type="text" class="form-control" name="name" id="name" placeholder="Enter restaurant name" />
		</div>
		<div class="form-group">
			<label for="location">Address</label>
			<input v-model="resto.location" type="text" class="form-control" name="location" id="location" placeholder="Enter restaurant address" />
		</div>
		<div class="form-group">
			<label for="tables">Number of table</label>
			<input v-model="resto.tables" type="text" class="form-control" name="tables" id="tables" placeholder="Enter restaurant tables" />
		</div>

		<button class="btn btn-sm btn-secondary" @click="handleCancelBtn">Cancel</button>
		<button class="btn btn-sm btn-primary" @click="handleAddBtn">Add</button>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				resto: this.basicResto(),
			};
		},
		methods: {
			basicResto() {
				return { name: "", location: "", tables: 0 };
			},
			handleAddBtn() {
				this.$emit("addRestoEvent", this.resto);
			},
			handleCancelBtn() {
				this.resto = this.basicResto();
				this.$emit("modalCancel");
			},
		},
	};
</script>

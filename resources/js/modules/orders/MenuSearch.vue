<template>
	<div class="wrapper mb-3">
		<input type="search" v-model="searchString" class="form-control" placeholder="Search here..." />
	</div>
</template>

<script>
	export default {
		props: ["items"],
		data() {
			return {
				searchString: "",
			};
		},
		computed: {
			filteredList() {
				return this.items.filter((item) => {
					return item.name.toLowerCase().includes(this.searchString.toLowerCase());
				});
			},
		},
		watch: {
			searchString(value) {
				if (value != "") {
					window.eventBus.$emit("filteredList", this.filteredList);
				} else {
					window.eventBus.$emit("clearFilteredList");
				}
			},
		},
	};
</script>

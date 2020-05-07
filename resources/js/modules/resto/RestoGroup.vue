<template>
	<div class="resto-group__wrapepr mb-5">
		<div class="row">
			<div class="col-md-4 mb-4" v-for="resto in localResto" :key="resto.id">
				<card-component class="card">
					<template slot="title">{{ resto.name }}</template>
					<template slot="main">
						<div class="content-contai">
							<i class="fas fa-map-marker-alt text-danger"></i> {{ resto.location }} <br />
							<i class="fas fa-table text-info"></i> {{ resto.tables }} <br />
						</div>
						<a v-bind:href="resto.slug" class="card-link">Menu</a>
						<a v-bind:href="resto.ordersSlug" class="card-link">Orders</a>
					</template>
				</card-component>
			</div>

			<div class="col-md-4" v-if="showAddForm">
				<card-component>
					<template slot="title">Add new Restaurant</template>
					<template slot="main">
						<div class="add-button-wra">
							<button @click="handleAddNewResto" class="btn btn-sm btn-info">+</button>
						</div>
					</template>
				</card-component>
				<modal name="add-new-resto" height="55%">
					<div class="container mt-3 mb-1 ">
						<RestoAddForm @addRestoEvent="handleSave" @modalCancel="handleCancelResto" />
					</div>
				</modal>
			</div>
		</div>
	</div>
</template>

<script>
	import RestoAddForm from "./RestoAddForm.vue";
	import axios from "axios";
	export default {
		props: ["restos"],
		components: {
			RestoAddForm,
		},
		created() {
			this.localResto = this.restos;
		},
		computed: {
			showAddForm() {
				return this.localResto.length < 5 ? true : false;
			},
		},
		data() {
			return {
				localResto: [],
			};
		},
		methods: {
			handleAddNewResto() {
				this.$modal.show("add-new-resto");
			},
			handleCancelResto() {
				this.$modal.hide("add-new-resto");
			},
			handleSave(restoData) {
				axios.post("/api/resto", restoData).then((response) => this.localResto.unshift(response.data));
				this.$modal.hide("add-new-resto");
			},
		},
	};
</script>

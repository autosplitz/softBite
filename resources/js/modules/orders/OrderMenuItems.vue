<template>
	<div class="wrapper">
		<menu-search :items="items" />
		<menu-items :items="items" />
	</div>
</template>

<script>
	import MenuItems from "./MenuItems";
	import MenuSearch from "./MenuSearch";
	export default {
		props: ["items"],
		components: {
			MenuItems,
			MenuSearch,
		},
	};
</script>

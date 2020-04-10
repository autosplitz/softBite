<template>
  <div class="wrapper menu_container">
    <div class="row">
      <div class="col-md-8">
        <card-component>
          <template slot="title">My Menu Items</template>
          <template slot="main">
            <div class="section">
              <multiselect v-model="menu" :options="categories" />
            </div>
            <menu-group :items="currentMenuItems" />
          </template>
        </card-component>
      </div>
      <div class="col-md-4">
        <card-component>
          <template slot="title">Add Menu Items</template>
          <template slot="main">
            <menu-add-form :categories="categories" :resto-id="restoId" v-on:newMenuItemAdded="handleNewMenuItem" />
          </template>
        </card-component>
      </div>
    </div>
  </div>
</template>

<script>
import _ from "lodash";
import Multiselect from "vue-multiselect";
import MenuGroup from "./MenuGroups.vue";
import MenuAddForm from "./MenuAddForm.vue";
export default {
  name: "MenuContainer",
  props: ["items", "restoId"],
  components: {
    Multiselect,
    MenuGroup,
    MenuAddForm,
  },
  data() {
    return {
      localItems: "",
      menu: "",
      categories: [],
    };
  },
  created() {
    _.forEach(this.items, (item, key) => {
      this.categories.push(key);
    });
    this.menu = this.categories[0];
    this.localItems = this.items;
  },
  computed: {
    currentMenuItems() {
      return this.localItems[this.menu];
    },
  },
  methods: {
    handleNewMenuItem(item, category) {
      console.log("item ", item);
      this.localItems[category].unshift(item);
    },
  },
};
</script>

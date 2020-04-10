<template>
  <div class="add_form_warpper">
    <form v-on:submit.prevent="handleSubmit">
      <div class="form-group">
        <label for="name">Food Item</label>
        <input type="text" v-model="food.item" class="form-control" placeholder="Enter food item name" />
        <div class="validation-message" v-text="validation.getMessage('item')"></div>
      </div>

      <div class="form-group">
        <label for="name">Select Category</label>
        <multiselect v-model="food.category" :options="categories"></multiselect>
        <div class="validation-message" v-text="validation.getMessage('category')"></div>
      </div>

      <div class="form-group">
        <label for="price">Price</label>
        <input type="number" v-model="food.price" class="form-control" placeholder="Enter food item price" />
        <div class="validation-message" v-text="validation.getMessage('price')"></div>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea type="text" v-model="food.description" class="form-control" placeholder="Enter food description"></textarea>
        <div class="validation-message" v-text="validation.getMessage('description')"></div>
      </div>

      <div class="form-group">
        <button class="btn btn-sm btn-info float-right">Save</button>
      </div>
    </form>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import Validation from "./../../utils/validation.js";
export default {
  name: "MenuAddForm",
  props: ["categories", "restoId"],
  components: {
    Multiselect,
  },
  data() {
    return {
      food: this.emptyFoodItem(),
      validation: new Validation(),
    };
  },

  methods: {
    emptyFoodItem() {
      return {
        item: "",
        category: "",
        price: 100,
        description: "",
      };
    },
    handleSubmit() {
      console.log("Form data: ", this.food);
      let postData = this.food;
      postData.restoId = this.restoId;
      window.axios
        .post("api/item/save", postData)
        .then((response) => {
          this.$emit("newMenuItemAdded", response.data, postData.category);
          this.food = this.emptyFoodItem();
          console.log("response", response.data);
        })
        .catch((error) => {
          console.log("error", error.response);
          if (error.response.status == 422) {
            this.validation.setMessages(error.response.data.errors);
          }
        });
    },
  },
};
</script>

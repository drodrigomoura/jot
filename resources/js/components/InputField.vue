<template>
  <div class="relative pb-4">
    <label
      :for="name"
      class="text-blue-500 pt-2 text-xs uppercase font-bold absolute"
      >{{ label }}</label
    >
    <input
      :id="name"
      type="text"
      class="pt-8 w-full border-b pb-2 focus:outline-none focus:border-blue-400 text-gray-900"
      :class="errorClassObject()"
      :placeholder="placeholder"
      v-model="value"
      @input="updateField()"
    />
    <p class="text-red-600 text-sm" v-text="errorMessage()">Error Here</p>
  </div>
</template>

<script>
export default {
  name: "InputField",

  props: ["name", "label", "placeholder", "errors", "data"],

  data: () => {
    return {
      value: "",
    };
  },

  computed:{
    hasErrors(){
      return this.errors && this.errors[this.name] && this.errors[this.name].length > 0;
    }
  },

  methods: {
    updateField() {
      this.clearErrors();
      this.$emit("update:field", this.value);
    },

    errorMessage() {
      if (this.hasErrors) {
        return this.errors[this.name][0];
      }
    },

    clearErrors() {
      if (this.hasErrors) {
        this.errors[this.name] = null;
      }
    },

    errorClassObject(){
      return {
        'error-field': this.hasErrors
      }
    }
  },

  watch:{
    data: function(val) {
      this.value=val;
    }
  }
};
</script>

<style>
  .error-field{
    @apply .border-red-500 .border-b-2
  }
</style>
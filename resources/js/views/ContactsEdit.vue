<template>
  <div>
    <div class="flex justify-between">
      <a class="text-blue-400" @click="$router.back()"> < Back </a>
    </div>

    <form @submit.prevent="handleSubmit">
      <InputField
        name="name"
        label="Contact Name"
        placeholder="Contact Name"
        @update:field="form.name = $event"
        :errors="errors"
        :data="form.name"
      />
      <InputField
        name="email"
        label="Contact Email"
        placeholder="Contact Email"
        @update:field="form.email = $event"
        :errors="errors"
        :data="form.email"
      />
      <InputField
        name="company"
        label="Company"
        placeholder="Company"
        @update:field="form.company = $event"
        :errors="errors"
        :data="form.company"
      />
      <InputField
        name="birthday"
        label="Birthday"
        placeholder="MM/DD/YYYY"
        @update:field="form.birthday = $event"
        :errors="errors"
        :data="form.birthday"
      />
      <div class="flex justify-end">
        <button
          class="py-2 px-4 rounded text-red-700 border mr-5 hover:border-red-700"
        >
          Cancel
        </button>
        <button
          class="bg-blue-500 py-2 px-4 text-white rounded hover:bg-blue-400"
        >
          Save
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import InputField from "../components/InputField";
export default {
  name: "ContactsEdit",

  components: {
    InputField,
  },

  mounted() {
    axios
      .get(`/api/contacts/${this.$route.params.id}`)
      .then((res) => {
        this.form = res.data.data;
        console.log(this.form);
        this.loading = false;
      })
      .catch((err) => {
        this.loading = false;
        if (err.response.status === 404) {
          this.$router.push("/contacts");
        }
      }); 
  },

  data: () => {
    return {
      form: {
        name: "",
        email: "",
        company: "",
        birthday: "",
      },
      errors: null,
    };
  },

  methods: {
    handleSubmit() {
      axios
        .patch(`/api/contacts/${this.$route.params.id}`, this.form)
        .then((res) => {
          this.$router.push(res.data.links.self);
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        });
    },
  },
};
</script>

<style>
</style>
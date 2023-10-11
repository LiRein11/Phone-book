<template>
  <div>
    <h3>Пользователь</h3>
    <div class="container">
      <form @submit="validateAndSubmit">
        <div v-if="errors.length">
          <div
            class="alert alert-danger"
            v-bind:key="index"
            v-for="(error, index) in errors"
          >
            {{ error }}
          </div>
        </div>
        <fieldset class="form-group">
          <label>ФИО</label>
          <input type="text" class="form-control" v-model="name" />
        </fieldset>
        <fieldset class="form-group">
          <label>Телефон</label>
          <input type="text" class="form-control" v-model="phone" />
        </fieldset>
        <fieldset class="form-group">
          <label>Организация</label>
          <input type="text" class="form-control" v-model="organization" />
        </fieldset>
        <button class="btn btn-success" type="submit">Сохранить</button>
      </form>
    </div>
  </div>
</template>
<script>
import UserDataService from "../service/UserDataService";

export default {
  name: "User",
  data() {
    return {
      name: "",
      phone: "",
      organization: "",
      errors: [],
    };
  },
  computed: {
    id() {
      return this.$route.params.id;
    },
  },
  methods: {
    refreshUserDetails() {
       if (this.id != -1) {
          UserDataService.retrieveUser(this.id).then((res) => {
            this.name = res.data.name;
            this.phone = res.data.phone;
            this.organization = res.data.organization;
          });
       }
    },
    validateAndSubmit(e) {
      e.preventDefault();
      this.errors = [];

      if (!this.name) {
        this.errors.push("Введите действительные значения в ФИО");
      } else if (this.name.length < 5) {
        this.errors.push("Введите не менее 5 символов в ФИО.");
      }
      if (!this.phone) {
        this.errors.push("Введите действительные значения в телефон");
      } else if (isNaN(this.phone) && isNaN(parseFloat(this.phone))) {
        this.errors.push("Введите не менее 10 цифр.");
      }
      
      if (this.errors.length === 0) {
        if (this.id == -1) {
          UserDataService.createUser({
            name: this.name,
            phone: this.phone,
            organization: this.organization,
          }).then(() => {
            this.$router.push("/users");
          });
        } else {
          UserDataService.updateUser({
            id: this.id,
            name: this.name,
            phone: this.phone,
            organization: this.organization,
          }).then(() => {
            this.$router.push("/users");
          });
        }
      }
    },
  },
  created() {
    this.refreshUserDetails();
  },
};
</script>

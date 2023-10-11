<template>
  <div class="container">
    <h3>Все пользователи</h3>
    <div v-if="message" class="alert alert-success">{{ this.message }}</div>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>ФИО</th>
            <th>Телефон</th>
            <th>Организация</th>
            <th>Обновить</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" v-bind:key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.phone }}</td>
            <td>{{ user.organization }}</td>
            <td>
              <button class="btn btn-warning" v-on:click="updateUser(user.id)">
                Обновить
              </button>
            </td>
            <td>
              <button class="btn btn-danger" v-on:click="deleteUser(user.id)">
                Удалить
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="row">
        <button class="btn btn-success" v-on:click="addUser()">Добавить</button>
      </div>
    </div>
  </div>
</template>
<script>
import UserDataService from "../service/UserDataService";

export default {
  name: "Users",
  data() {
    return {
      users: [],
      message: "",
    };
  },
  methods: {
    refreshUsers() {
      UserDataService.retrieveAllUsers().then((res) => {
        this.users = res.data;
      });
    },
    addUser() {
      this.$router.push(`/user/-1`);
    },
    updateUser(id) {
      this.$router.push(`/user/${id}`);
    },
    deleteUser(id) {
       UserDataService.deleteUser(id).then(() => {
        this.refreshUsers();
      });
    },
  },
  created() {
    this.refreshUsers();
  },
};
</script>
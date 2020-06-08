<template>
  <div>
    <h1>Todo Detail</h1>
    <form @submit.prevent="updateTodo">
      <div v-if="errors" class="errors">
        <ul v-if="errors">
          <li v-for="msg in errors" :key="msg">{{ msg }}</li>
        </ul>
      </div>
      <table v-if="todo" class="table table-hover">
        <thead>
          <tr>
            <th>id</th>
            <th>note</th>
            <th>created</th>
            <th>updated</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ todo.id }}</td>
            <td>
              <input type="text" name="note" v-model="todo.note" />
            </td>
            <td>{{ todo.created }}</td>
            <td>{{ todo.updated }}</td>
            <td>
              <button type="submit">update</button>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    <RouterLink to="/">back</RouterLink>
  </div>
</template>
<script>
import { OK, UNPROCESSABLE_ENTITY, NO_CONTENT } from "../../util";

export default {
  props: {
    id: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      todo: null,
      errors: null
    };
  },
  methods: {
    async fetchTodo() {
      const response = await axios
        .get(`/api/todos/${this.id}`)
        .catch(error => error.response);

      if (response.status === NO_CONTENT) {
        this.$store.commit("message/setContent", {
          content: "データが見つかりません",
          timeout: 6000,
          alert_type: "alert-danger"
        });
      }

      console.log(response);
      console.log(response.status);
      console.log(this.todo);
      if (response.status !== OK) {
        this.$store.commit("error/setCode", response.status);
        return false;
      }
      this.todo = response.data;
    },
    async updateTodo() {
      const response = await axios
        .post(`/api/todos/${this.id}`, {
          note: this.todo.note
        })
        .catch(error => error.response);
      console.log(response);
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.errors = response.data.errors;
        console.log(this.errors);
        return false;
      }
      if (response.status !== OK) {
        this.$store.commit("error/setCode", response.status);
        return false;
      }

      this.$store.commit("message/setContent", {
        content: "更新しました",
        timeout: 6000,
        alert_type: "alert-success"
      });
      this.$router.push("/");
      //this.$store.commit("message/setContent", {content: ""});
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.fetchTodo();
      },
      immediate: true
    }
  }
};
</script>
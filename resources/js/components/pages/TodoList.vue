<template>
  <div>
    <h1>Todo Lists</h1>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>id</th>
          <th>note</th>
          <th>created</th>
          <th>updated</th>
          <th>更新</th>
          <th>削除</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="todo in todos" :key="todo.id">
          <td>{{ todo.id }}</td>
          <td>{{ todo.note }}</td>
          <td>{{ todo.created }}</td>
          <td>{{ todo.updated }}</td>
          <td>
            <RouterLink :to="`/todos/${todo.id}`">update</RouterLink>
          </td>
          <td>
            <button @click="deleteItem(todo.id)" class="btn btn-danger">delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import { OK } from "../../util";

export default {
  data() {
    return {
      todos: []
    };
  },
  methods: {
    async fetchTodos() {
      const response = await axios
        .get("/api/todos")
        .catch(error => error.response);
      console.log(response);

      if (response.status !== OK) {
        this.$store.commit("error/setCode", response.status);
        return false;
      }

      this.todos = response.data;
    },
    async deleteItem(id) {
      const response = await axios
        .delete(`/api/todos/${id}`)
        .catch(error => error.response);

      if (response.status !== OK) {
        this.$store.commit("error/setCode", response.status);
        return false;
      }

      this.todos = response.data;

      this.$store.commit("message/setContent", {
        content: "削除しました",
        timeout: 6000,
        alert_type: "alert-success"
      });
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.fetchTodos();
      },
      immediate: true
    }
  }
};
</script>
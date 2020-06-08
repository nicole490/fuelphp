<template>
  <div>
    <h1>Todo Register</h1>
    <form @submit.prevent="registerTodo">
      <div v-if="errors" class="errors">
        <ul v-if="errors">
          <li v-for="msg in errors" :key="msg">{{ msg }}</li>
        </ul>
      </div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>note</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <input type="text" name="note" v-model="note" />
            </td>
            <td>
              <button type="submit">register</button>
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
  data() {
    return {
      errors: null,
      note: null
    };
  },
  methods: {
    async registerTodo() {
      const response = await axios
        .post("/api/todos", {
          note: this.note
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
        content: "登録しました",
        timeout: 6000,
        alert_type: "alert-success"
      });
      this.$router.push("/");
    }
  }
};
</script>
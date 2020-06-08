<template>
  <div>
    <header>
      <HeaderItem />
    </header>
    <main>
      <div class="container">
        <MessageItem />
        <RouterView />
      </div>
    </main>
  </div>
</template>

<script>
import MessageItem from "./components/globals/MessageItem.vue";
import HeaderItem from "./components/globals/HeaderItem.vue";
import { NOT_FOUND, INTERNAL_SERVER_ERROR, NO_CONTENT } from "./util";

export default {
  components: {
    MessageItem,
    HeaderItem
  },
  computed: {
    errorCode() {
      return this.$store.state.error.code;
    }
  },
  watch: {
    errorCode: {
      async handler(val) {
        if (val === INTERNAL_SERVER_ERROR) {
          this.$router.push("/500");
        } else if (val === NOT_FOUND) {
          this.$router.push("/not-found");
        } else if (val === NO_CONTENT) {
          this.$router.push("/");
        }
      },
      immediate: true
    },
    $route() {
      this.$store.commit("error/setCode", null);
      
    }
  }
};
</script>
<template>
  <div class="alert" :class="alert_type" v-show="message">{{ message }}</div>
</template>

<script>
import { mapState } from "vuex";

export default {
  computed: {
    ...mapState({
      message: state => state.message.content,
      alert_type: state => state.message.alert_type
    })
  },
  created() {
    this.$store.commit("message/removeContent");
  }
};
</script>
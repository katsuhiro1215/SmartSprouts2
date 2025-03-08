<script setup>
import { computed } from "vue";

const props = defineProps({
  type: {
    type: String,
    default: "button",
  },
  provider: {
    type: String,
    required: true,
  },
});

const getIconSrc = computed(() => {
  switch (props.provider.toLowerCase()) {
    case "google":
      return "/upload/google.png";
    case "facebook":
      return "/upload/facebook.png";
    case "twitter":
      return "/upload/twitter.png";
    case "github":
      return "/upload/github.png";
    case "line":
      return "/upload/line.png";
    default:
      return "/upload/default-oauth.png";
  }
});
</script>

<template>
  <button
    :type="type"
    class="relative w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block"
  >
    <img
      :src="getIconSrc"
      alt="OAuth Icon"
      width="24"
      class="absolute top-2 left-4"
    />
    <span class="ml-4">{{ provider }}でログイン</span>
  </button>
</template>

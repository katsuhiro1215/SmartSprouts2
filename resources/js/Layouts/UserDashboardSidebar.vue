<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  active: {
    type: Boolean,
  },
});

const classes = computed(() => props.active ? "" : "");

</script>

<template>
  <aside>
    <ul class="flex flex-col gap-4">
      <li>
        <!-- <Link :href="route()" :active="route().current('')">Home</Link> -->
         Link
      </li>
    </ul>
  </aside>
</template>

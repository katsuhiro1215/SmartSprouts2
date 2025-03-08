<script setup>
import { inject, computed, defineProps } from "vue";

const props = defineProps({
  index: {
    type: Number,
    required: true,
  },
});

const selectedTab = inject("selectedTab");
const isActive = computed(() => selectedTab.value === props.index);
</script>

<template>
  <div v-show="isActive" class="p-4">
    <slot></slot>
  </div>
</template>
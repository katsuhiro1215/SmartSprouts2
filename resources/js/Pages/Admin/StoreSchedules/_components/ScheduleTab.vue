<script setup>
import { defineProps } from 'vue';
// Components
import Button from '@/Components/Buttons/Button.vue';

const props = defineProps({
  stores: Array,
  currentTab: String,
  changeTab: Function,
});
</script>

<template>
  <div class="flex items-center gap-3">
    <Button
      v-for="store in stores"
      :key="store.id"
      @click="changeTab(store.id)"
      buttonActionType="button"
      :buttonType="currentTab === store.id ? 'primary' : 'secondary'"
      :class="{ 'font-bold': currentTab === store.id }"
      >{{ store.name }}</Button
    >
  </div>
</template>
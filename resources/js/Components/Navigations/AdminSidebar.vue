<script setup>
import { defineProps } from 'vue';
import ButtonLink from '@/Components/Buttons/ButtonLink.vue';

const props = defineProps({
  menuItems: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <aside class="w-16 sm:w-20 lg:w-24 h-full bg-white dark:bg-gray-800 shadow-md">
    <nav class="w-full">
      <ul class="w-full flex flex-col space-y-4">
        <li v-for="item in menuItems" :key="item.name">
          <ButtonLink
            :href="route(item.route)"
            :imgSrc="item.icon"
            :label="item.label"
            buttonType="primary"
          />
        </li>
      </ul>
    </nav>
  </aside>
</template>
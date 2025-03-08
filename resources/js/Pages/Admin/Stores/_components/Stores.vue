<script setup>
import { defineProps } from 'vue';
import Card from '@/Components/Cards/Card.vue';

const props = defineProps({
  items: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <div v-if="items.length === 0">
    <Card>
      <template #content>
        <slot name="empty" />
      </template>
    </Card>
  </div>
  <div v-else>
    <div class="flex flex-col gap-4">
      <Card v-for="item in items" :key="item.id" :item="item">
        <template #content>
          <slot name="renderItem" :item="item" />
        </template>
      </Card>
    </div>
  </div>
</template>
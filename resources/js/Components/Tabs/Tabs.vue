<script setup>
import TabsList from './TabsList.vue';

</script>

<template>
  <div>
    <TabsList>
      <slot name="triggers"></slot>
    </TabsList>
    <div class="mt-4">
      <slot name="contents"></slot>
    </div>
  </div>
</template>
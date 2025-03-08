<script setup>
import { defineProps } from 'vue';
import Avatar from '@/Components/Avatar.vue';
import Badge from '@/Components/Badge.vue';
import Button from '@/Components/Buttons/Button.vue';

const props = defineProps({
  item: {
    type: Array,
    required: true,
  },
  userRole: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <div class="flex items-center justify-between gap-4">
    <Avatar :src="item.logo" size="xxl" />
    <div class="flex flex-col gap-3 items-start justify-between">
      <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
        {{ item.name }}
      </h3>
      <div class="flex flex-col space-y-2 text-slate-600 dark:text-slate-300">
        <dl class="flex gap-2 text-sm">
          <dt>Location:</dt>
          <dd>{{ item.full_address }}</dd>
        </dl>
        <dl class="flex gap-2 text-sm">
          <dt>Type:</dt>
          <dd>{{ item.type }}</dd>
        </dl>
        <dl class="flex gap-2 text-sm">
          <dt>Email:</dt>
          <dd>{{ item.email }}</dd>
        </dl>
        <dl class="flex gap-2 text-sm">
          <dt>Phone:</dt>
          <dd>{{ item.phone_number }}</dd>
        </dl>
      </div>
    </div>
    <div class="flex justify-center items-center">
      <Badge v-if="item.status == '1'" type="success"> OPEN </Badge>
      <Badge v-if="item.status == '0'" type="danger"> CLOSE </Badge>
    </div>
    <div class="w-24 flex flex-col justify-end items-center gap-4">
      <Button :href="route('admin.store.show', item.id)" buttonActionType="button" buttonType="info"
        >詳細</Button
      >
      <Button
        v-if="['Owner', 'SuperAdmin', 'Manager'].includes(userRole)"
        :href="route('admin.store.edit', item.id)"
        buttonActionType="button"
        buttonType="warning"
        >編集</Button
      >
    </div>
  </div>
</template>
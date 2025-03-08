<script setup>
import { ref, computed } from 'vue';
// Components
import ListView from '@/Components/ListView.vue';

const props = defineProps({
  storeSchedules: Array,
});
</script>

<template>
  <ListView
    :items="storeSchedules"
    :headers="['SL', '店舗名', '営業日 (曜日)', '営業時間 (開店時間 - 閉店時間)', 'Action']"
  >
    <template #renderItem="{ item, index }">
      <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ index + 1 }}
      </td>
      <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ item.store.name }}
      </td>
      <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ item.start_date }} ({{ item.day_of_week }})
      </td>
      <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ item.start_date }} - {{ item.end_date }}
      </td>
      <td
        class="flex gap-3 p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
      >
        <Button @click="editStoreSchedule(item)" buttonType="warning" class="size-10">
          <NoteEdit />
        </Button>
        <Button @click="requestDeletion(item, 'delete')" buttonType="danger" class="size-10">
          <TrashCanOutline />
        </Button>
      </td>
    </template>
  </ListView>
</template>
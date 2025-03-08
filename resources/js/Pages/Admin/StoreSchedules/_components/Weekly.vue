<script setup>
import { ref, computed } from 'vue';
import BaseWeekly from '@/Components/Calendar/Weekly.vue';

const props = defineProps({
  storeSchedules: Array,
});

// 週の初めの日を取得
const weekStartDate = ref(new Date());

// 背景色を取得
const getBackgroundColor = (date, time) => {
  const schedule = props.storeSchedules.find((schedule) => {
    console.log(schedule);
    const scheduleStartDate = new Date(schedule.start_date);
    const scheduleEndDate = new Date(schedule.end_date);
    const scheduleStartTime = scheduleStartDate.toTimeString().slice(0, 5);
    const scheduleEndTime = scheduleEndDate.toTimeString().slice(0, 5);

    return (
      scheduleStartDate.toDateString() === date.toDateString() &&
      scheduleStartTime <= time &&
      time < scheduleEndTime
    );
  });
  return schedule ? schedule.store.theme_color : '';
};

// 店舗名を取得
const getStoreName = (date, time) => {
  const schedule = props.storeSchedules.find(schedule => {
    const scheduleStartDate = new Date(schedule.start_date);
    const scheduleStartTime = scheduleStartDate.toTimeString().slice(0, 5);

    return (
      scheduleStartDate.toDateString() === date.toDateString() &&
      scheduleStartTime === time
    );
  });

  return schedule ? schedule.store.name : '';
};

// スケジュールの店舗を取得
const uniqueStores = computed(() => {
  const storeIds = [...new Set(props.storeSchedules.map(schedule => schedule.store_id))];
  return storeIds.map(storeId => {
    const store = props.storeSchedules.find(schedule => schedule.store_id === storeId).store;
    return {
      id: storeId,
      name: store.name,
      theme_color: store.theme_color,
    };
  });
});
</script>

<template>
  <div>
    <div v-for="store in uniqueStores" :key="store.id" class="mb-8">
      <h3 class="text-lg font-bold mb-4">{{ store.name }}</h3>
      <BaseWeekly :weekStartDate="weekStartDate">
        <template #cell="{ date, time }">
          <td :style="{ backgroundColor: getBackgroundColor(date, time, store.id) }" class="border h-12 p-2 align-top">
            <span v-if="getStoreName(date, time)" class="text-sm">{{ getStoreName(date, time) }}</span>
          </td>
        </template>
      </BaseWeekly>
    </div>
  </div>
</template>
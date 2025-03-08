<script setup>
import { defineProps, ref, computed } from 'vue';
import BaseDaily from '@/Components/Calendar/Daily.vue';

const props = defineProps({
  storeSchedules: Array,
  date: Date,
});

const filteredSchedules = computed(() => {
  return props.storeSchedules.filter((schedule) => {
    const scheduleDate = new Date(schedule.date);
    return scheduleDate.toDateString() === props.date.toDateString();
  });
});

const getBackgroundColor = (date, time) => {
  const schedule = filteredSchedules.value.find((schedule) => {
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
</script>

<template>
  <div>
    <BaseDaily :initialDate="date" @update:date="updateDate" />
    <div class="grid grid-cols-2 gap-2">
      <div
        v-for="time in timeSlots"
        :key="time"
        :style="{ backgroundColor: getBackgroundColor(currentDate.value, time) }"
        class="border p-2 text-center"
      >
      test
        <!-- {{ time }} -->
      </div>
    </div>
  </div>
</template>
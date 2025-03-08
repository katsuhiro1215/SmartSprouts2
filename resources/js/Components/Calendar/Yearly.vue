<script setup>
import { ref, computed } from "vue";

const monthsOfYear = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
const props = defineProps({
  year: Number,
});

// 各月の開始日を取得
const monthStartDates = computed(() => {
  const dates = [];
  for (let i = 0; i < 12; i++) {
    dates.push(new Date(props.year, i, 1));
  }
  return dates;
});
</script>

<template>
  <div class="yearly-calendar">
    <div v-for="(monthStartDate, index) in monthStartDates" :key="index" class="mb-4">
      <h3 class="text-center font-semibold">{{ monthsOfYear[index] }}</h3>
      <Monthly :monthStartDate="monthStartDate">
        <template #default>
          <!-- イベントなどを表示するスロット -->
        </template>
      </Monthly>
    </div>
  </div>
</template>
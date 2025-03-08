<script setup>
import { ref, computed } from "vue";

const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
const props = defineProps({
  monthStartDate: Date,
});

// 月のカレンダーの日付を取得
const monthDates = computed(() => {
  const dates = [];
  const startDate = new Date(props.monthStartDate);
  startDate.setDate(1);
  const startDay = startDate.getDay();
  startDate.setDate(startDate.getDate() - startDay);

  for (let i = 0; i < 42; i++) {
    dates.push(new Date(startDate));
    startDate.setDate(startDate.getDate() + 1);
  }

  return dates;
});
</script>

<template>
  <div class="monthly-calendar">
    <table class="table-fixed w-full border-collapse border">
      <thead>
        <tr>
          <th
            v-for="(day, index) in daysOfWeek"
            :key="index"
            class="border p-2 text-center bg-gray-100"
          >
            {{ day }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="week in 6" :key="week">
          <td
            v-for="(date, index) in monthDates.slice((week - 1) * 7, week * 7)"
            :key="index"
            class="border h-24 p-2 align-top"
          >
            <div class="text-right text-xs font-semibold">
              {{ date.getDate() }}
            </div>
            <!-- イベントなどを表示するスロット -->
            <slot :date="date"></slot>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
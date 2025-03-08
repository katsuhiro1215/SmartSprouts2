<script setup>
import { ref, watch } from 'vue';
import { HOLIDAYS } from '@/Constants/holidays';
import Button from '@/Components/Buttons/Button.vue';

const props = defineProps({
  weekStartDate: Date,
});

// 曜日
const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

// 1週間分の日付を取得
const weekDates = ref([]);
const updateWeekDates = (startDate) => {
  weekDates.value = [];
  for (let i = 0; i < 7; i++) {
    weekDates.value.push(new Date(startDate.getTime() + i * 24 * 60 * 60 * 1000));
  }
};

// 初期設定
const weekStartDate = ref(new Date(props.weekStartDate));
updateWeekDates(weekStartDate.value);

// 30分おきの時間を取得
const timeSlots = ref([]);
for (let i = 0; i < 24; i++) {
  for (let j = 0; j < 60; j += 30) {
    timeSlots.value.push(`${String(i).padStart(2, '0')}:${String(j).padStart(2, '0')}`);
  }
}

// 週の変更を監視
watch(weekStartDate, (newDate) => {
  updateWeekDates(newDate);
});

// 祝日かどうかを判定する関数
const getHoliday = (date) => {
  return HOLIDAYS.find((holiday) => new Date(holiday.date).toDateString() === date.toDateString());
};
</script>

<template>
  <div class="weekly-calendar">
    <div class="flex justify-between mb-4">
      <Button @click="weekStartDate = new Date(weekStartDate.getTime() - 7 * 24 * 60 * 60 * 1000)">
        Prev
      </Button>
      <Button @click="weekStartDate = new Date(weekStartDate.getTime() + 7 * 24 * 60 * 60 * 1000)">
        Next
      </Button>
    </div>
    <table class="table-fixed w-full border-collapse border">
      <thead>
        <tr>
          <th class="border p-2 text-center bg-gray-100">Time</th>
          <th
            v-for="(date, index) in weekDates"
            :key="index"
            :class="{
              'border p-2 text-center bg-gray-100': true,
              'text-blue-500': date.getDay() === 6, // 土曜日
              'text-red-500': date.getDay() === 0, // 日曜日
              'text-red-500': getHoliday(date), // 祝日
            }"
          >
            {{ daysOfWeek[date.getDay()] }}<br />
            {{ date.getMonth() + 1 }}/{{ date.getDate() }}
            <span v-if="getHoliday(date)"> <br />{{ getHoliday(date).name }} </span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(time, timeIndex) in timeSlots" :key="timeIndex">
          <td
            class="border h-12 p-2 align-top text-right text-xs"
            :class="{
              'font-semibold': time.endsWith(':00'),
              'text-gray-500': time.endsWith(':30'),
            }"
          >
            {{ time }}
          </td>
          <slot
            name="cell"
            v-for="(date, dateIndex) in weekDates"
            :key="dateIndex"
            :date="date"
            :time="time"
          >
            <td class="border h-12 p-2 align-top">
              <!-- デフォルトのスロット内容 -->
            </td>
          </slot>
        </tr>
      </tbody>
    </table>
  </div>
</template>

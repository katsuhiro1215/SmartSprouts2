<script setup>
import { defineProps, ref, computed, watch } from 'vue';
import { HOLIDAYS } from '@/Constants/holidays';
import Button from '@/Components/Buttons/Button.vue';

const props = defineProps({
  initialDate: Date,
});

// 曜日
const dayOfWeek = ['日', '月', '火', '水', '木', '金', '土'];

// 今日の日付を取得
const currentDate = ref(new Date(props.initialDate));

// 初期設定
const updateDate = (date) => {
  currentDate.value = new Date(date);
};
updateDate(props.initialDate);

// 30分おきの時間を取得
const timeSlots = ref([]);
for (let i = 0; i < 24; i++) {
  for (let j = 0; j < 60; j += 30) {
    timeSlots.value.push(`${String(i).padStart(2, '0')}:${String(j).padStart(2, '0')}`);
  }
}

// 祝日かどうかを判定する関数
const getHoliday = (date) => {
  return HOLIDAYS.find((holiday) => new Date(holiday.date).toDateString() === date.toDateString());
};

// 前の日 & 次の日に移動
const prevDay = () => {
  currentDate.value.setDate(currentDate.value.getDate() - 1);
};
const nextDay = () => {
  currentDate.value.setDate(currentDate.value.getDate() + 1);
};

// 日付の変更を監視
watch(currentDate, (newDate) => {
  emit('update:date', newDate);
});
</script>

<template>
  <div class="daily-calendar">
    <div class="flex justify-between mb-4">
      <Button @click="prevDay">Prev</Button>
      <Button @click="nextDay">Next</Button>
    </div>
    <table class="fixed w-full border-collapse border">
      <thead>
        <tr>
          <th class="border p-2 w-full text-center bg-gray-100">Time</th>
          <th
            :class="{
              'border p-2 text-center bg-gray-100': true,
              'text-blue-500': currentDate.getDate() === 6, // 土曜日
              'text-red-500': currentDate.getDay() === 0, // 日曜日
              'text-red-500': getHoliday(currentDate), // 祝日
            }"
          >
            {{ dayOfWeek[currentDate.getDay()] }}<br />
            {{ currentDate.getMonth() + 1 }}月{{ currentDate.getDate() }}日
            <span v-if="getHoliday(currentDate)"> <br />{{ getHoliday(currentDate) }}</span>
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
          <slot name="cell" :date="currentDate" :time="time">
            <td class="border h-12 p-2 align-top">
              <!-- デフォルトのスロット内容 -->
            </td>
          </slot>
        </tr>
      </tbody>
    </table>
  </div>
</template>
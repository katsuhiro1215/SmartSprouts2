<script setup>
import ScheduleList from './ScheduleList.vue';
import DailySchedule from './DailySchedule.vue';
import WeeklySchedule from './WeeklySchedule.vue';
import MonthlySchedule from './MonthlySchedule.vue';
import YearlySchedule from './YearlySchedule.vue';

const props = defineProps({
  storeSchedules: Array,
});
</script>

<template>
  <div>
    <ScheduleList :storeSchedules="storeSchedules" />
    <DailySchedule :storeSchedules="storeSchedules" />
    <WeeklySchedule :storeSchedules="storeSchedules" />
    <MonthlySchedule :storeSchedules="storeSchedules" />
    <YearlySchedule :storeSchedules="storeSchedules" />
  </div>
</template>
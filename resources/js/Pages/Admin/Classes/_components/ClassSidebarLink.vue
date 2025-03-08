<script setup>
import AdminSidebar from '@/Components/Navigations/AdminSidebar.vue';

const menuItems = [
  {
    name: 'lesson.index',
    label: 'レッスン一覧',
    icon: '/upload/store.png',
    route: 'admin.lesson.index',
  },
  {
    name: 'lesson.create',
    label: 'レッスン新規作成',
    icon: '/upload/store.png',
    route: 'admin.lesson.create',
  },
  {
    name: 'storeSchedule.index',
    label: 'コースカテゴリー一覧',
    icon: '/upload/store.png',
    route: 'admin.courseCategory.index',
  },
  {
    name: 'storeSchedule.index',
    label: 'コースカテゴリー新規作成',
    icon: '/upload/store.png',
    route: 'admin.courseCategory.create',
  },
  {
    name: 'storeSchedule.index',
    label: 'コース一覧',
    icon: '/upload/store.png',
    route: 'admin.courseCategory.index',
  },
  {
    name: 'storeSchedule.index',
    label: 'コース新規作成',
    icon: '/upload/store.png',
    route: 'admin.courseCategory.create',
  },
  {
    name: 'courseSchedule.index',
    label: 'コース日程Import',
    icon: '/upload/store.png',
    route: 'admin.lesson.index',
  },
  {
    name: 'courseSchedule.index',
    label: 'コース日程Export',
    icon: '/upload/store.png',
    route: 'admin.lesson.index',
  },
];
</script>

<template>
  <AdminSidebar :menuItems="menuItems" />
</template>
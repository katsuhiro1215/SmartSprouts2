<script setup>
import AdminSidebar from '@/Components/Navigations/AdminSidebar.vue';

const menuItems = [
  {
    name: 'event.index',
    label: 'イベント一覧',
    icon: '/upload/store.png',
    route: 'admin.event.index',
  },
  {
    name: 'lesson.create',
    label: 'イベント新規作成',
    icon: '/upload/store.png',
    route: 'admin.lesson.create',
  },
  {
    name: 'trial.index',
    label: '体験教室一覧',
    icon: '/upload/store.png',
    route: 'admin.trial.index',
  },
  {
    name: 'trial.create',
    label: '体験教室新規作成',
    icon: '/upload/store.png',
    route: 'admin.lesson.create',
  },
  {
    name: 'shortTerm.index',
    label: '短期教室一覧',
    icon: '/upload/store.png',
    route: 'admin.shortTerm.index',
  },
  {
    name: 'trial.create',
    label: '短期教室新規作成',
    icon: '/upload/store.png',
    route: 'admin.shortTerm.create',
  },
  {
    name: 'application.index',
    label: '申込一覧',
    icon: '/upload/store.png',
    route: 'admin.application.index',
  },
];
</script>

<template>
  <AdminSidebar :menuItems="menuItems" />
</template>
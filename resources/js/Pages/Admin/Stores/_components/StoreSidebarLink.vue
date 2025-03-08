<script setup>
import AdminSidebar from '@/Components/Navigations/AdminSidebar.vue';

const menuItems = [
  {
    name: 'store.index',
    label: '店舗一覧',
    icon: '/upload/store.png',
    route: 'admin.store.index',
  },
  {
    name: 'store.create',
    label: '店舗新規作成',
    icon: '/upload/store.png',
    route: 'admin.store.create',
  },
  {
    name: 'storeSchedule.index',
    label: '店舗日程一覧',
    icon: '/upload/store.png',
    route: 'admin.storeSchedule.index',
  },
  {
    name: 'storeSchedule.index',
    label: '店舗日程新規作成',
    icon: '/upload/store.png',
    route: 'admin.storeSchedule.index',
  },
  {
    name: 'storeSchedule.index',
    label: '店舗日程Import',
    icon: '/upload/store.png',
    route: 'admin.storeSchedule.index',
  },
  {
    name: 'storeSchedule.index',
    label: '店舗日程Export',
    icon: '/upload/store.png',
    route: 'admin.storeSchedule.index',
  },
];
</script>

<template>
  <AdminSidebar :menuItems="menuItems" />
</template>
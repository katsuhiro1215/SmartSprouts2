<script setup>
import AdminSidebar from '@/Components/Navigations/AdminSidebar.vue';

const menuItems = [
  {
    name: 'user.index',
    label: 'システム管理',
    icon: '/upload/family.png',
    route: 'admin.systemSetting.index',
  },
  {
    name: 'user.index',
    label: 'システム詳細',
    icon: '/upload/family.png',
    route: 'admin.systemSetting.index',
  },
];
</script>

<template>
  <AdminSidebar :menuItems="menuItems" />
</template>
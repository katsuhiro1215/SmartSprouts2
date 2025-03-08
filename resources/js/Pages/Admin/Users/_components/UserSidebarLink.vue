<script setup>
import AdminSidebar from '@/Components/Navigations/AdminSidebar.vue';

const menuItems = [
  {
    name: 'user.index',
    label: '顧客管理',
    icon: '/upload/family.png',
    route: 'admin.user.index',
  },
  {
    name: 'student.index',
    label: '生徒管理',
    icon: '/upload/children.png',
    route: 'admin.student.index',
  },
  {
    name: 'guardian.index',
    label: '保護者管理',
    icon: '/upload/parents.png',
    route: 'admin.guardian.index',
  },
  {
    name: 'guardian.index',
    label: 'リスト管理',
    icon: '/upload/store.png',
    route: 'admin.guardian.index',
  },
];
</script>

<template>
  <AdminSidebar :menuItems="menuItems" />
</template>
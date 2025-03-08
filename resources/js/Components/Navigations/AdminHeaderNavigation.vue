<script setup>
import NavLink from '@/Components/NavLink.vue';

const defaultMenuItems = [
  { name: 'home', route: 'admin.dashboard', label: 'ホーム', icon: '/upload/house.png' },
  { name: 'user', route: 'admin.user.index', label: '顧客', icon: '/upload/family.png' },
  { name: 'user', route: 'admin.user.index', label: '出席', icon: '/upload/attendance.png' },
  { name: 'admin', route: 'admin.admin.index', label: '管理者', icon: '/upload/admin.png' },
  { name: 'store', route: 'admin.store.index', label: '店舗', icon: '/upload/store.png' },
  { name: 'class', route: 'admin.class.index', label: 'クラス', icon: '/upload/sports.png' },
  { name: 'event', route: 'admin.event.index', label: 'イベント', icon: '/upload/event.png' },
  { name: 'school', route: 'admin.school.index', label: '学校', icon: '/upload/school.png' },
  { name: 'ec', route: 'admin.user.index', label: 'EC', icon: '/upload/shopping.png' },
  {
    name: 'questionnaire',
    route: 'admin.questionnaire.index',
    label: 'アンケート',
    icon: '/upload/note.png',
  },
  { name: 'task', route: 'admin.widget.index', label: 'タスク管理', icon: '/upload/task.png' },
  {
    name: 'contact',
    route: 'admin.contact.index',
    label: 'お問い合わせ',
    icon: '/upload/email.png',
  },
  { name: 'widget', route: 'admin.widget.index', label: 'ウィジェット', icon: '/upload/menu.png' },
  { name: 'settings', route: 'admin.settings.index', label: '設定', icon: '/upload/settings.png' },
];
</script>

<template>
  <nav class="w-full flex items-center bg-blue-400">
    <ul class="hidden w-full md:flex flex-wrap items-center gap-6 px-4 py-2 overflow-hidden">
      <li v-for="item in defaultMenuItems" :key="item.name">
        <NavLink
          :href="route(item.route)"
          :active="route().current(item.route)"
          class="flex-col gap-2"
        >
          <img :src="item.icon" :alt="item.label" width="32" />
          <span class="text-sm">{{ item.label }}</span>
        </NavLink>
      </li>
    </ul>
  </nav>
</template>
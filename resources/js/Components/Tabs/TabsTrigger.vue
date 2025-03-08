<script setup>
import { inject, computed, defineProps } from "vue";

const props = defineProps({
  index: {
    type: Number,
    required: true,
  },
});

// 親から受け取る状態とメソッド
const selectedTab = inject("selectedTab");
const setSelectedTab = inject("setSelectedTab");

// 現在選択されているタブかどうかを計算プロパティで判断
const selected = computed(() => selectedTab.value === props.index);

const selectTab = () => {
  setSelectedTab(props.index);
};
</script>

<template>
  <button
    @click="selectTab"
    :class="[
      'py-2 px-4 font-semibold text-gray-600',
      selected
        ? 'text-blue-500 border-b-2 border-blue-500'
        : 'hover:text-blue-500',
    ]"
  >
    <slot></slot>
  </button>
</template>
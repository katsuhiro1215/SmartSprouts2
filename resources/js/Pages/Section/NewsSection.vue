<script setup>
import Badge from '@/Components/Badge.vue';
import Button from '@/Components/Buttons/Button.vue';
import Section from '@/Components/Section.vue';

</script>

<template>
  <Section>
    <template #header>
      <h2 class="text-center">News</h2>
    </template>
    <template #content>
      <ul class="w-full flex flex-col bg-yellow-400">
        <li class="w-full py-2 px-4 rounded-full bg-red-200 hover:bg-slate-200 transition-all">
          <a href="#">
            <article class="flex justify-between items-center">
              <div class="flex items-center">
                <div class="w-40 flex items-center">
                  <Badge type="success"> お知らせ </Badge>
                </div>
                <h4 class="w-[calc(100%-160px)]">タイトル</h4>
              </div>
              <div class="flex items-center">
                <time class="text-sm text-slate-600">2024.01.01</time>
              </div>
            </article>
          </a>
        </li>
      </ul>
      <Button buttonType="primary">一覧</Button>
    </template>
  </Section>
</template>

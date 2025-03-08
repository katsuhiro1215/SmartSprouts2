<script setup>
</script>

<template>
  <div class="absolute bottom-3 w-full flex justify-center mx-auto py-3">
    <ul class="w-full flex flex-col max-w-3xl bg-white rounded-full">
      <li class="w-full py-2 px-4 rounded-full bg-red-200 hover:bg-slate-200 transition-all">
        <a href="">
          <article class="flex justify-between items-center">
            <div class="flex items-center">
              <div class="w-40 flex items-center">
                <h5
                  class="inline-block text-sm py-2 px-3 rounded-full bg-white overflow-x-hidden whitespace-nowrap"
                >
                  お知らせ
                </h5>
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
  </div>
</template>

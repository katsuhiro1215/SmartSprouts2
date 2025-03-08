<template>
  <div class="bg-blue-100 w-full rounded-lg p-4 shadow">
    <ul class="relative flex flex-col gap-2 md:flex-row">
      <li
        class="group flex flex-1 flex-col items-center gap-2 md:flex-row"
        data-stepper-nav-item='{ "index": 1 }'
      >
        <span
          class="min-h-7.5 min-w-7.5 group inline-flex flex-col items-center gap-2 align-middle text-sm md:flex-row text-indigo-400"
        >
          <span class="flex flex-shrink-0 items-center justify-center rounded-full font-medium">
            <span class="text-sm">1</span>
            <span class="hidden size-4 flex-shrink-0"></span>
            <span class="hidden size-4 flex-shrink-0"></span>
          </span>
          <span class="text-nowrap font-medium">ユーザー情報</span>
        </span>
        <div
          class="h-px w-full group-last:hidden max-md:mt-2 max-md:h-8 max-md:w-px md:flex-1"
        ></div>
      </li>
      <li
        class="group flex flex-1 flex-col items-center gap-2 md:flex-row"
        data-stepper-nav-item='{ "index": 1 }'
      >
        <span
          class="min-h-7.5 min-w-7.5 group inline-flex flex-col items-center gap-2 align-middle text-sm md:flex-row"
        >
          <span class="flex flex-shrink-0 items-center justify-center rounded-full font-medium">
            <span class="text-sm">2</span>
            <span class="hidden size-4 flex-shrink-0"></span>
            <span class="hidden size-4 flex-shrink-0"></span>
          </span>
          <span class="text-nowrap font-medium">生徒登録</span>
        </span>
        <div
          class="h-px w-full group-last:hidden max-md:mt-2 max-md:h-8 max-md:w-px md:flex-1"
        ></div>
      </li>
      <li
        class="group flex flex-1 flex-col items-center gap-2 md:flex-row"
        data-stepper-nav-item='{ "index": 1 }'
      >
        <span
          class="min-h-7.5 min-w-7.5 group inline-flex flex-col items-center gap-2 align-middle text-sm md:flex-row"
        >
          <span class="flex flex-shrink-0 items-center justify-center rounded-full font-medium">
            <span class="text-sm">3</span>
            <span class="hidden size-4 flex-shrink-0"></span>
            <span class="hidden size-4 flex-shrink-0"></span>
          </span>
          <span class="text-nowrap font-medium">保護者登録</span>
        </span>
        <div
          class="h-px w-full group-last:hidden max-md:mt-2 max-md:h-8 max-md:w-px md:flex-1"
        ></div>
      </li>
      <li
        class="group flex flex-1 flex-col items-center gap-2 md:flex-row"
        data-stepper-nav-item='{ "index": 4 }'
      >
        <span
          class="min-h-7.5 min-w-7.5 group inline-flex flex-col items-center gap-2 align-middle text-sm md:flex-row"
        >
          <span class="flex flex-shrink-0 items-center justify-center rounded-full font-medium">
            <span class="text-sm">4</span>
            <span class="hidden size-4 flex-shrink-0"></span>
            <span class="hidden size-4 flex-shrink-0"></span>
          </span>
          <span class="text-nowrap font-medium">住所登録</span>
        </span>
        <div
          class="h-px w-full group-last:hidden max-md:mt-2 max-md:h-8 max-md:w-px md:flex-1"
        ></div>
      </li>
      <li
        class="group flex flex-1 flex-col items-center gap-2 md:flex-row"
        data-stepper-nav-item='{ "index": 5 }'
      >
        <span
          class="min-h-7.5 min-w-7.5 group inline-flex flex-col items-center gap-2 align-middle text-sm md:flex-row"
        >
          <span class="flex flex-shrink-0 items-center justify-center rounded-full font-medium">
            <span class="text-sm">5</span>
            <span class="hidden size-4 flex-shrink-0"></span>
            <span class="hidden size-4 flex-shrink-0"></span>
          </span>
          <span class="text-nowrap font-medium">生徒申込情報</span>
        </span>
        <div
          class="bg-red-300 h-px w-full group-last:hidden max-md:mt-2 max-md:h-8 max-md:w-px md:flex-1"
        ></div>
      </li>
    </ul>
  </div>
</template>